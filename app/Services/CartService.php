<?php


namespace App\Services;

use App\Models\Product;
use Cart;

class CartService
{

    public  function isSale(){
        if(\Cart::getTotal() >= Product::DEFAULT_PRICE_SALE){
            return true;
        }
        return false;
    }

    public  function getTotalCart(){
        $total = 0;
        foreach (\Cart::getContent() as $item){
           $total +=  $item->associatedModel->priceTotal*$item->quantity;
        }
        return $total;
    }

    public function getSaleTotalCart(){
        $total = 0;
        foreach (\Cart::getContent() as $item){
            $total += $item->associatedModel->priceold*$item->quantity;
        }
        return $total;
    }
}
