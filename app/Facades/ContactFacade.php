<?php


namespace App\Facades;

use App\Services\ContactService;
use Illuminate\Support\Facades\Facade;

class ContactFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ContactService::class;
    }
}
