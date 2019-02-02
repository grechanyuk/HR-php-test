<?php

namespace App\Mail;

use App\Order;
use App\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompleteOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @param Collection $products
     * @param Order $order
     * @param Vendor $vendor
     */
    public function __construct(Collection $products, Order $order, Vendor $vendor = null)
    {
        $this->data['vendor'] = $vendor;
        $this->data['products'] = $products;
        $this->data['order'] = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.completeOrder', $this->data);
    }
}
