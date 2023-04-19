<?php


namespace App\Facades;

use App\Services\CartService;

class CartFacade extends \Darryldecode\Cart\Facades\CartFacade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return CartService::class;
    }
}
