<?php

namespace App\Http\Livewire;
use App\Models\Product;
use Cart;

use App\Traits\CartTrait;
use Livewire\Component;

class CartAddProduct extends Component
{
    use CartTrait;

    protected $listeners = ['refreshCart' => '$refresh'];

    public $btnClass;

    public function mount($product,$btn_class=null){

        $this->product = $product;

        $this->btnClass = $btn_class === null ? 'button' : $btn_class;
    }

    public function minus(){
        $multiple = $this->product->multiple;
        $this->minusCart($this->product,$multiple?:1,true);
    }

    public function plus(){
        $this->plusCart($this->product,$this->product->multiple?:1);
    }

    public function render()
    {
        $qtu = 0;

        if($cart = Cart::get( $this->product->id)){
            $qtu = $cart->quantity;
        }

        return view('livewire.cart-add-product',[
            'qtu' => $qtu,
            'multiple' => $this->product->multiple?:1,
        ]);
    }
}
