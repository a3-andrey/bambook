<?php

namespace App\Facades;
use App\Services\SliderService;
use Illuminate\Support\Facades\Facade;

class SliderFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return SliderService::class;
    }
}


