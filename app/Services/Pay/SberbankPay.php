<?php


namespace App\Services\Pay;


use App\Contracts\PayContract;
use App\Models\Transaction;

class SberbankPay implements PayContract
{
    public function pay(Transaction $order)
    {
        // TODO: Implement pay() method.

        return 'реализация оплаты через Сбер';
    }

}
