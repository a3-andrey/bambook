<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class AcademyController extends Controller
{
    //
    public function index()
    {
        $posts = Post::rubric()->search()->get();
        return view('pages.dashboard.academy',['posts'=>$posts]);
    }

    public function show(Post $post){
        return view('pages.dashboard.academy-show',['post'=>$post]);
    }
}
