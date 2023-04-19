<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class SearchController extends Controller
{
    public function search(Request $search){
        $product = Product::where('name', 'like', '%'.$search->data.'%')->get();

        if(count($product) === 0){
            $product[0] = 'Товаров по такому запросов нет';
        }

        return $product;
    }
}
