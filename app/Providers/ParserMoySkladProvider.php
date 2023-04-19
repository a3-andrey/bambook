<?php

namespace App\Providers;

use App\Contracts\ParserMoySkladContract;
use App\Contracts\PayContract;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class ParserMoySkladProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ParserMoySkladContract::class, function ($app) {

            $default = Arr::get(config('pay.services'),config('pay.default'));

            return new $default();
        });
    }




}
