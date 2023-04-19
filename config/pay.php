<?php
return [

    'type_default' => 'not_pay',

    'services' => [
        'yandex-money' => \App\Services\Pay\YandexMoneyPay::class,
        'sberbank' => \App\Services\Pay\SberbankPay::class,
    ],

    'services_extensions' => [
        'yandex-money' => [
            'shop_id' => env('YANDEX_SHOP_ID'),
            'shop_key' => env('YANDEX_SHOP_KEY'),
            'return_url' => env('YANDEX_RETURN_URL'),
        ]
    ],

    'default' => 'yandex-money',

];
