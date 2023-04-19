<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('cart')->group(function (){

    Route::post('/total', [\App\Http\Controllers\CartController::class, 'total'])
        ->name('cart-total');

    Route::post('/add', [\App\Http\Controllers\CartController::class, 'add'])
        ->name('cart-add');

    Route::post('/plus', [\App\Http\Controllers\CartController::class, 'plus'])
        ->name('cart-plus');

    Route::post('/minus', [\App\Http\Controllers\CartController::class, 'minus'])
        ->name('cart-minus');

    Route::post('update', [\App\Http\Controllers\CartController::class, 'update'])
        ->name('cart-update');

    Route::post('/delete', [\App\Http\Controllers\CartController::class, 'destroy'])
        ->name('cart-delete');

});

Route::prefix('moysklad')->name('moysklad.')->group(function (){

    Route::get('organization',\App\Http\Controllers\API\OrganizationController::class)->name('organization');
});



                        /** Admin */
Route::post('menu/{menuItem}/menu-item/update',[\App\Admin\Controllers\API\MenuContentController::class,'update'])
    ->name('api.menu-item.update');

Route::get('menu-item/{menuItem}/delete',[\App\Admin\Controllers\API\MenuContentController::class,'delete'])
    ->name('api.menu-item.delete');
                    /** End Admin */
