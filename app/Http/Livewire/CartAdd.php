<?php

namespace App\Http\Livewire;
use App\Facades\CartFacade;
use App\Models\Product;
use App\Services\CartService;
use App\Traits\CartTrait;
use Livewire\Component;
use Cart;

class CartAdd extends Component
{
    use CartTrait;

    protected $listeners = ['refreshCart' => '$refresh'];

    public $isProduct;

    public function mount($product,$isProduct=false){

        $this->product = $product;

        $this->isProduct = $isProduct;
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

        return view('livewire.cart-add',[
            'qtu' => $qtu,
            'multiple' => $this->product->multiple?:1,
            'isSale' => CartFacade::isSale(),
        ]);
    }
}

//    public function updatedQtu($val){
//        $this->updateCart();
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
//        $this->emit('productAdd');
//    }

//    public function add(){
//        $this->cartAdd();
//    }

//    public function trashCart($cartID){
//        $product = Product::find($cartID);
//        $this->mount($product);
//        $this->updateCart();
//    }

//    public function cartAdd(){
//
//        Cart::add(array(
//            'id' => $this->product->id,
//            'slug' => $this->product->slug,
//            'name' => $this->product->name,
//            'price' => $this->product->priceold,
//            'article' => $this->product->article,
//            'quantity' => $this->multiple,
//            'attributes' => [
//                'image' => $this->product->image,
//                'link' => route('product',$this->product->slug),
//                'article' => $this->product->article
//            ],
//            'associatedModel' => $this->product
//        ));
//
//        $this->mount($this->product);
//
//        $this->emit('productAdd');
//    }
