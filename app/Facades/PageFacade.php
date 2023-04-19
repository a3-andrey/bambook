<?php namespace App\Facades;


use App\Services\PageService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Ixudra\Curl\Builder to(string $url)
 */
class PageFacade extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return PageService::class;
    }

}
