<?php


namespace App\Entity;

class Pay
{
    /**
     * @var string
     */
    private $typePay;

    private const TYPE_PAY = [
        'yandex-money' => \App\Services\Pay\YandexMoneyPay::class,
        'sberbank' => \App\Services\Pay\SberbankPay::class,
    ];

    public const DEFAULT = 'yandex-money';

    public function __construct(string $typePay=null)
    {
        $this->typePay = $typePay;
    }

    public function setTypePay(string $typePay)
    {
        $this->typePay = $typePay;

        return $this;
    }

    public function pay(){

        switch ($this->typePay) {
            case 1:
                echo "i равно 1";
                break;
            case 2:
                echo "i равно 2";
                break;
            default:
                ;
        }

    }



}
