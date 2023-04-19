<?php

namespace App\Providers;

use App\Contracts\PayContract;
use App\Models\Order;
use App\Services\Pay\YandexMoneyPay;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class PayServiceProvider extends ServiceProvider
{

    public $order;

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PayContract::class, function ($app) {

            $default = Arr::get(config('pay.services'),config('pay.default'));

            return new $default();
        });
    }



    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //

    }
}
