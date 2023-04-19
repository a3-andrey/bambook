<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Product;
use App\Traits\CartTrait;
use Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartMain extends Component
{

    use  CartTrait;

    protected $listeners = ['refreshCart' => '$refresh'];

    public $total;

    public function mount(){
        $this->total = Cart::getTotal();
    }

    public function clearCart(){
        Cart::clear();
    }

    public function uCart($total){
        $this->total = $total;
    }

    public function remove(){
        $this->render();
    }


    public function submit(){
        return redirect()->route('order');
    }

    public function minus($productID){
        $product = Product::find($productID);
        $multiple = $product->multiple;
        $this->minusCart($product,$multiple?$multiple:1,false);
    }

    public function plus($productID){
        $product = Product::find($productID);
        $this->plusCart($product,$product->multiple?:1);
    }

    public function updCart($productID,$qtu){
        $this->updateCart($productID,$qtu);
    }

    public function render()
    {
        return view('livewire.cart-main',[
            'items' => Cart::getContent()->sortByDesc('id'),
            'total' => Cart::getTotal(),
        ]);
    }
}
