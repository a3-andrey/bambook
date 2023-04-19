<?php


namespace App\Services\Pay;

use App\Contracts\PayContract;
use App\Dependence\PayProcess;
use App\Models\Order;
use App\Models\Pay;
use App\Models\Transaction;
use YooKassa\Client;
use YooKassa\Model\NotificationEventType;

class YandexMoneyPay extends PayProcess implements PayContract
{
    public $client;

    public function __construct()
    {
        $client = new Client();

        $this->client = $client->setAuth(
            config('pay.services_extensions.yandex-money.shop_id'),
            config('pay.services_extensions.yandex-money.shop_key')
        );
    }

    public function pay(Order $order){

        $payment = $this->client->createPayment(
            array(
                'amount' => array(
                    'value' => $order->total,
                    'currency' => 'RUB',
                ),
                'confirmation' => array(
                    'type' => 'redirect',
                    'return_url'=> route('yandexmoneycheckout',['order_id' => $order->id]) ,
                ),
                'capture' => true,
                'description' => 'Номер транзакции: '.$order->id,
            ),
            uniqid('', true)
        );

        Transaction::create([
            'summa' => $order->total,
            'hash' => $payment->id,
            'status' =>  $payment->status,
        ]);

        return $payment->getConfirmation()->getConfirmationUrl();

    }

    public function status(string $pauID)
    {

        $payment = $this->client->getPaymentInfo($pauID);

        return $payment->status?$payment->status:null;
    }

    public function addWebhook()
    {
        $response = $this->client->addWebhook([
            "event" => NotificationEventType::PAYMENT_SUCCEEDED,
            "url"   => "yandex-money/notification/succeeded",
        ]);
    }

}
