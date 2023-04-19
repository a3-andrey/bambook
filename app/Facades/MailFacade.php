<?php


namespace App\Facades;

use App\Services\MailService;
use Illuminate\Support\Facades\Facade;

class MailFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return MailService::class;
    }
}
