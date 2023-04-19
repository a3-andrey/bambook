<?php

namespace App\Http\Controllers;

use App\Contracts\PayContract;
use App\Models\Order;


class PaymentController extends Controller
{

    public $orderID;

    public $order;

    public $pay;

    public $status;

    public function __construct()
    {
        $this->orderID = \request('order_id');

        if(is_null($this->orderID)){
            return abort(403,'Произошла непредвиденная ошибка');
        }

        $this->order = Order::findOrFail($this->orderID);

        $this->pay =  $this->order->pay;
    }

    public function getPaymentStatus(PayContract $payContract)
    {
        $this->status = $payContract->status($this->pay->merchant_id);

       $this->pay->update([
           'status' => $this->status
       ]);

       return redirect()->route('payment.success');
    }


}
