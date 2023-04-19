<?php


namespace App\Contracts;

use App\Models\Order;

interface PayContract
{
    /**
     * @param Order $order
     * @return mixed
     */
    public function pay(Order $order);

    /**
     * @param string $transaction_token
     * @return mixed
     */
    public function status(string $transaction_token);
}
