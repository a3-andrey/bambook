<?php namespace App\Facades;

use App\Services\MenuService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Ixudra\Curl\Builder to(string $url)
 */
class MenuFacade extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return MenuService::class;
    }

}
