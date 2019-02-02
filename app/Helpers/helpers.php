<?php
if(!function_exists('getOrderTotal')) {
    /**
     * @param \App\Order|\Illuminate\Database\Eloquent\Collection $order
     * @return float|int
     */
    function getOrderTotal($order) {
        $total = 0;
        if($order instanceof \App\Order) {
            foreach ($order->orderProducts as $product) {
                $total = $total + ($product->price * $product->quantity);
            }
        } else {
            foreach ($order as $product) {
                $total = $total + ($product->price * $product->quantity);
            }
        }

        return $total;
    }
}

if(!function_exists('getOrderStatusName')) {
    function getOrderStatusName(int $statusId) {
        switch ($statusId) {
            case 0:
                $str = 'Новый';
                break;
            case 10:
                $str = 'Подтвержден';
                break;
            case 20:
                $str = 'Завершен';
                break;
            default:
                $str = 'Необычный';
        }

        return $str;
    }
}