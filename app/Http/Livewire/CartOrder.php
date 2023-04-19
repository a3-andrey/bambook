<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class CartOrder extends Component
{
    public $item,$multiple,$product;

    public function mount($item){
        $this->item = $item;
        $this->product = $item->associatedModel;
        $this->multiple = $this->product->multiple?:1;
    }

    public function plus(){
        $quantity = $this->item['quantity']+$this->multiple;
        $this->upCart($quantity);
    }

    public function minus(){
        $quantity = $this->item['quantity']-$this->multiple;

        if($quantity>1){
            $this->upCart($quantity);
        }
    }

    public function del($rowId){
        $this->total = Cart::remove($rowId);
        $this->emit('remove');
    }

    private function upCart($quantity){
        if($quantity!=0){
             Cart::update($this->product->id, [
                'quantity' => [
                    'relative' => false,
                    'value' =>  $quantity,
                ]
            ]);

            $this->mount(Cart::get($this->product->id));

            $this->emit('uCart',Cart::getTotal());
        }
    }

    public function render()
    {
        return view('livewire.cart-order');
    }
}
