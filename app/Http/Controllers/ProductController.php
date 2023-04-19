<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Meta;

class ProductController extends Controller
{
    //
    public function __invoke(Product $product){
        Meta::set('title', config('app.name').' | '.$product->name);
        $categories = $product->categories;
        $products = collect();
           if($categories->count() > 0){
               $cat = $categories->sortBy('id')->first();

                $intersectionCat = Category::whereIn('id',$cat->intersections?:[])->get();
                foreach ($intersectionCat as $insector){
                    $products = $products->merge($insector->products);
                }
               $products = $products->take(8);
           }

        $prices = $product->prices->filter(function ($val){
            return $val->name == 'Цена "опт"' ||
                $val->name == 'Цена "крупный опт"' ||
                $val->name == 'Цена "спец цена"';
        });

        return view('pages.product',[
            'prices' => $prices,
            'product' => $product,
            'categories' => $categories,
           'productRelated' => $products,
        ]);
    }
}
