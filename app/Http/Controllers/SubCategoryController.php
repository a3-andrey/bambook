<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Meta;

class SubCategoryController extends Controller
{
    //
    public function __invoke(Category $category,$subcategory){
        $subcategory = Category::where('slug',$subcategory)->firstOrFail();
        Meta::set('title', config('app.name').' | '.$category->category.' - '.$subcategory->category);
       return view('pages.subcategory',[
           'category' => $category,
           'subcategory' => $subcategory,
       ]);
    }
}
