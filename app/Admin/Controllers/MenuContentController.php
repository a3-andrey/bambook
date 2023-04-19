<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use Encore\Admin\Layout\Content;
use Encore\Admin\Facades\Admin;

class MenuContentController extends Controller
{
    public function index(Menu $menu)
    {
        return Admin::content(function (Content $content)use($menu) {
            // optional
            $content->header('Меню ');
            // optional
            $content->description('редактировать');
            // add breadcrumb since v1.5.7
            $content->breadcrumb(
                ['text' => 'Меню', 'url' => '/menu'],
                ['text' => 'Меню - редактировать', 'url' => ''],
            );
            $content->view('admin.menu.index',[
                'menu'=>$menu,
            ]);
        });
    }

    public function edit(Menu $menu,MenuItem $menuItem)
    {
        return Admin::content(function (Content $content)use($menu,$menuItem) {
            // optional
            $content->header($menuItem->title);
            // optional
            $content->description('редактировать');
            // add breadcrumb since v1.5.7
            $content->breadcrumb(
                ['text' => 'Меню', 'url' => '/menu'],
                ['text' => 'Меню - редактировать', 'url' => route('admin.menu-content',$menu)],
                ['text' => $menuItem->title, 'url' => ''],
            );
            $content->view('admin.menu.edit',[
                'menu'=>$menu,
                'menuItem'=>$menuItem,
            ]);
        });
    }

    public function update(Menu $menu,MenuItem $menuItem){
        $data = request()->only([
            'parent_id',
            'title',
            'icon',
            'uri',
            'target',
            'parameters',
        ]);

        $menuItem->update($data);
        return redirect()->route('admin.menu-content',$menu);
    }

    public function create(Menu $menu)
    {
        request()->validate([
            'title' => 'required|max:255',
        ]);
        MenuItem::create([
            'title' => request('title'),
            'parent_id' => request('parent_id'),
            'menu_id' => $menu->id,
            'icon' => request('icon'),
            'uri' => request('uri'),
            'target' => request('target'),
            'parameters' => request('parameters'),
        ]);

        return redirect()->back();
    }


}
