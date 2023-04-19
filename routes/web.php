<?php

use App\Facades\MoySklad_1_2_Facade;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',\App\Http\Controllers\MainController::class)->name('main');

Route::get('catalog/{category:slug}/category',\App\Http\Controllers\CategoryController::class)->name('category');

Route::get('catalog/{category:slug}/category/{subcategory:slug}/subcategory',\App\Http\Controllers\SubCategoryController::class)
    ->name('category.subcategory');

Route::get('product/{product:slug}',\App\Http\Controllers\ProductController::class)->name('product');

Route::get('product/{product:slug}/modifier/{modifier}',\App\Http\Controllers\ProductController::class)
    ->name('product.modifiers');

Route::view('cart','pages.cart')->name('cart');

Route::get('order',function (){

    return view('pages.order',[
        'delivery' => request('delivery'),
        'order' => request('order')
    ]);
})->name('order');

Route::view('contacs', 'pages.contacs')->name('contacs');

Route::view('whosales', 'pages.whosales')->name('whosales');

Route::view('message', 'pages.message')->name('message');

Route::prefix('dashboard')->middleware(['auth','verified'])->group(function (){

    Route::get('/', function () {
        return view('pages.dashboard.home',[
            'user'=>\Illuminate\Support\Facades\Auth::user(),
            'orders' => \Illuminate\Support\Facades\Auth::user()->orders,
        ]);
    })->name('dashboard');

});

Route::view('polit','pages.polit')->name('polit');

require __DIR__.'/auth.php';




