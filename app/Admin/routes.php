<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->get('refresh-cash', function (){
        Artisan::call('config:cache');
        return redirect()->back();
    });

    $router->resource('promotions', PromotionController::class);

    $router->resource('categories', CategoryController::class);

    $router->resource('advantages', AdvantageController::class);

    $router->resource('texts', TextController::class);

    $router->resource('users/three', Tree::class);

    $router->resource('products', ProductController::class);

    $router->resource('intersections', CategoryController::class);

    $router->resource('reviews', ReviewController::class);

    $router->resource('counters', CounterController::class);

    $router->resource('sliders', SliderController::class);

    $router->resource('pages',  PageController::class);

    $router->resource('users', UserController::class);

    $router->resource('transactions', TransactionController::class);

    /** Config */
    Route::get('admin-config', AdminConfigController::class.'@index');
    Route::post('admin-config', AdminConfigController::class.'@update');
    /** End Config */

    /** Menu */
    $router->resource('menu',  MenuController::class);
    $router->get('menu/{menu}',  [\App\Admin\Controllers\MenuContentController::class,'index'])
        ->name('menu-content');
    $router->post('menu/{menu}/create',  [\App\Admin\Controllers\MenuContentController::class,'create'])
        ->name('menu-content.create');
    $router->get('menu/{menu}/menu-item/{menuItem}/edit',  [\App\Admin\Controllers\MenuContentController::class,'edit'])
        ->name('menu-content.edit');
    $router->post('menu/{menu}/menu-item/{menuItem}/update',  [\App\Admin\Controllers\MenuContentController::class,'update'])
        ->name('menu-content.update');
    /** End Menu */


    /** Menu */
    Route::get('text/ui/update',[\App\Admin\Controllers\TextController::class,'uiUpdated'])->name('text.ui.updated');

    /** End Menu */

});
