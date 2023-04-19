<?php namespace App\Facades;

use App\Services\MoySklad_1_2_Service;
use Illuminate\Support\Facades\Facade;

class MoySklad_1_2_Facade extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return MoySklad_1_2_Service::class;
    }

}
