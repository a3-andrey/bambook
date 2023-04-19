<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Meta;

class CategoryController extends Controller
{
    //
    public function __invoke(Category $category){
        Meta::set('title', config('app.name').' | '.$category->category);
       return view('pages.category',[
           'category' => $category
       ]);
    }
}
