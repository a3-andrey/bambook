<?php namespace App\Facades;

use App\Services\MoySkladOrderService;
use Illuminate\Support\Facades\Facade;

class MoySkladOrderFacade extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return MoySkladOrderService::class;
    }

}
