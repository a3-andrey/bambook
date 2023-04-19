<?php

namespace App\Http\Controllers;

use Meta;

class MainController extends Controller
{
    //
    public function __invoke(){
        Meta::set('title', config('site.title'));
        Meta::set('description', config('site.description'));
        Meta::set('keywords', config('site.keywords'));
        return view('pages.main');
    }
}
