<?php

namespace App\Facades;

use App\Services\TextService;
use Illuminate\Support\Facades\Facade;

class TextFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return TextService::class;
    }
}
