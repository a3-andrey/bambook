<?php

namespace App\Facades;
use App\Contracts\PayContract;
use Illuminate\Support\Facades\Facade;

class PayFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return PayContract::class;
    }
}
