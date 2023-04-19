<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Cart;

class Category extends Component
{
    use \App\Traits\CartTrait;

    protected $listeners = ['refreshCart' => '$refresh'];

    public
        $category,
        $totalItems,
        $sort = 'DESC',
        $paginate;
    public $btnClass,$qtu=0,$multiple;

    public const PAGINATION = 12;

    public function mount($category){
        $this->paginate = self::PAGINATION;
        $this->category = $category;
       $this->totalItems = $category->products()->active()->count();
    }

    public function sort(){
        $this->sort ==='ASC' ? $this->sort = 'DESC' : $this->sort = 'ASC';
    }

    public function showMore(){
        $this->paginate += self::PAGINATION;
    }

    public function setQtu(Product $product,$qtu){
        if($qtu<=0){
            $qtu = 1;
        }
        $this->updateCart($product,$qtu);
    }

    public function add(Product $product){

        $this->cartAdd($product);
    }

    public function plus(Product $product){
        $cart = Cart::get($product->id);
        $qtu = $cart->quantity;
        $qtu = (int)$qtu;
        $qtuProd = $product->multiple?:1;
        $qtuProd = (int)$qtuProd;
        $qtu+=$qtuProd;

        $this->updateCart($product,$qtu);
    }

    public function minus(Product $product){
        $cart = Cart::get($product->id);
        $qtu = $cart->quantity;
        $qtu = (int)$qtu;
        $qtuProd = $product->multiple?:1;
        $qtuProd = (int)$qtuProd;
        $qtu-=$qtuProd;

        $this->updateCart($product,$qtu);
    }

    public function cartAdd(Product $product){

        Cart::add(array(
            'id' => $product->id,
            'slug' => $product->slug,
            'name' => $product->name,
            'price' => $product->price,
            'article' => $product->article,
            'quantity' => $product->multiple?:1,
            'attributes' => [
                'image' => $product->image,
                'link' => route('product',$product->slug),
                'article' => $product->article
            ],
            'associatedModel' => $product
        ));

//        $this->mount($this->product);

        $this->emit('productAdd');
    }

    private function updateCart(Product $product,$qtu){

        if($qtu>0){
            Cart::update($product->id, [
                'quantity' => [
                    'relative' => false,
                    'value' =>  $qtu,
                ]
            ]);
        }else{
            Cart::remove($product->id);
        }
        $this->emit('productAdd');
    }

    public function render()
    {
        $poducts  = $this->category
            ->products()
            ->orderBy('price',$this->sort)
            ->limit($this->paginate)
            ->active()
            ->get();

        $poducts = $poducts->filter(function ($value, $key) {
            return $value->modifers->count() <= 0;
        });

        return view('livewire.category',[
            'products' => $poducts
        ]);
    }
}
