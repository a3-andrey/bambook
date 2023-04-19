<?php

namespace App\Http\Livewire;

use App\Facades\CartFacade;
use App\Models\Product;
use App\Traits\CartTrait;
use Livewire\Component;
use Cart;

class CartItem extends Component
{
    protected $listeners = ['refreshCart' => '$refresh'];

    use CartTrait;

    public function minus($productID){
        $product = Product::find($productID);
        $multiple = $product->multiple;
        $this->minusCart($product,$multiple?$multiple:1,false);
    }

    public function plus($productID){
        $product = Product::find($productID);
        $this->plusCart($product,$product->multiple?:1);
    }

    public function render()
    {
        $items = Cart::getContent()->sortByDesc('id');
        $total = CartFacade::getTotalCart();
        $totalSale = CartFacade::getSaleTotalCart();

        return view('livewire.cart-item',[
            'items' => $items,
            'total' => $total,
            'totalSale' => $totalSale,
        ]);
    }
}
