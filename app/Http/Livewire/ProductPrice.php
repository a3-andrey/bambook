<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Cart;


class ProductPrice extends Component
{
    public $product;

    protected $listeners = ['refreshCart' => '$refresh'];

    public function mount(Product $product){
        $this->product = $product;
    }

    public function render()
    {
        $qtu = 0;

        if($cart = Cart::get($this->product->id)){
            $qtu = $cart->quantity;
        }

        return view('livewire.product-price',[
            'qtu' => $qtu,
        ]);
    }
}
