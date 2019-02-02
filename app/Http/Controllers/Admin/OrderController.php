<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constants;
use App\Http\Controllers\Controller;
use App\Mail\CompleteOrder;
use App\Order;
use App\Partner;
use App\Vendor;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'overdueOrders' => Order::overdue()->take(50)->get(),
            'currentOrders' => Order::current()->get(),
            'newOrders' => Order::new()->take(50)->get(),
            'finishedOrders' => Order::finished()->take(50)->get()
        ];

        return view('admin.orders.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $data = [
            'order' => $order,
            'partners' => Partner::all()
        ];

        return view('admin.orders.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $this->validateForm($request);

        $order->update($request->all());

        if ($request->input('status') == Constants::$FINISH_ORDER_STATUS) {
            $this->notificate($order);
        }

        return redirect()->route('admin.orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    /**
     * @param Request $request
     */
    private function validateForm(Request $request)
    {
        $this->validate($request, [
            'client_email' => 'required|email',
            'partner_id' => 'required',
            'status' => 'required'
        ]);
    }

    private function notificate(Order $order)
    {
        $orderProducts = $order->products()->get(['products.name', 'order_products.quantity', 'order_products.price', 'products.vendor_id']);
        foreach ($orderProducts->groupBy('vendor_id') as $key => $products) {
            $vendor = Vendor::whereKey($key)->first();
            \Mail::to($vendor->email)->send(new CompleteOrder($products, $order, $vendor));
        }

        \Mail::to($order->partner->email)->send(new CompleteOrder($orderProducts, $order));
    }
}
