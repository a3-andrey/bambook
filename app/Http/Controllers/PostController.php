<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function show(Post $post){
        return view('pages.post',[
            'item'=>$post
        ]);
    }

    public function history(){
        $category = Category::find(1);
        $posts = $category->posts;
        return view('pages.history',compact('category','posts'));
    }

    public function library(){
        $category = Category::find(2);
        $posts = $category->posts;
        return view('pages.library',compact('category','posts'));
    }

}
