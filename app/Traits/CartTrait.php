<?php

namespace App\Traits;
use App\Models\Product;
use Cart;
use Illuminate\Support\Facades\Storage;

trait CartTrait
{
    public $product;


//    public function changeCart($productID,$symbol='plus'){
//        $cart = Cart::get($productID);
//        $quantity = $cart->quantity;
//        $product = $cart->associatedModel;
//        $multiple = $product->multiple?:1;
//
//        if($symbol === 'plus'){
//            $quantity = $quantity + $multiple;
//            if($quantity > 1){
//                Cart::update($product->id, [
//                    'quantity' => [
//                        'relative' => false,
//                        'value' =>  $quantity,
//                    ]
//                ]);
//            }
//        }
//
//        if($symbol === 'minus'){
//            $quantity = $quantity - $multiple;
//            if($quantity > 1){
//                Cart::update($product->id, [
//                    'quantity' => [
//                        'relative' => false,
//                        'value' =>  $quantity,
//                    ]
//                ]);
//            }else{
//                Cart::update($product->id, [
//                    'quantity' => [
//                        'relative' => false,
//                        'value' =>  1,
//                    ]
//                ]);
//            }
//        }
//
////        $this->emit('uCart',Cart::getTotal());
////        $this->emit('productAdd');
//        $this->emit( 'refreshCart');
//    }

//    private function updateCart(){
//        if($this->qtu!=0){
//            Cart::update($this->product->id, [
//                'quantity' => [
//                    'relative' => false,
//                    'value' =>  $this->qtu,
//                ]
//            ]);
//        }else{
//            Cart::remove($this->product->id);
//        }
////        $this->emit('productAdd');
//        $this->emit( 'refreshCart');
//    }

    public function updateCart($productID,$qtu){

        if($qtu<=0){
            $qtu = 1;
        }

        Cart::update($productID, [
            'quantity' => [
                'relative' => false,
                'value' =>  $qtu,
            ]
        ]);

        $this->emit( 'refreshCart');
    }

    public function plusCart(Product $product,$qtu){
        Cart::update($product->id, [
            'quantity' => [
                'relative' => true,
                'value' =>  $qtu,
            ]
        ]);
        $this->emit( 'refreshCart');
    }

    public function minusCart(Product $product,$qtu,$deleted=true){

        if($deleted){

            if(Cart::get($product->id)->quantity - $qtu <= 0){
              return $this->delete($product->id);
            }

        }

        Cart::update($product->id, [
            'quantity' => [
                'relative' => true,
                'value' =>  -$qtu,
            ]
        ]);

        $this->emit( 'refreshCart');
    }

    public function add(Product $product){

        Cart::add(array(
            'id' => $product->id,
            'slug' => $product->slug,
            'name' => $product->name,
            'price' => $product->price,
            'article' => $product->article,
            'quantity' => $product->multiple?:Product::DEFAULT_QTU,
            'attributes' => [
                'image' => $product->image,
                'link' => route('product',$product->slug),
                'article' => $product->article
            ],
            'associatedModel' => $product
        ));

        $this->emit( 'refreshCart');
    }

    public function delete($cartID){

        Cart::remove($cartID);

        $this->emit( 'refreshCart');

    }

    public function totalCart(){
        $total = 0;
        foreach (\Cart::getContent() as $item){
            $total+= $item->associatedModel->priceTotal*$item->quantity;
        }
        return $total;
    }
}



