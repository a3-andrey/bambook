<?php namespace App\Facades;

use App\Services\MoySkladService;
use Illuminate\Support\Facades\Facade;

class MoySkladFacade extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return MoySkladService::class;
    }

}
