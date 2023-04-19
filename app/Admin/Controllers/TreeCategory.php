<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\ModelForm;


class TreeCategory extends Controller
{
    use ModelForm;

    public function index()
    {

        return Admin::content(function (Content $content) {
            $content->header('Категории');
            $content->body(Category::tree(function ($tree) {
                $tree->branch(function ($branch) {
                    $status = $branch['is_active'] ? " <span class='label label-success'>Опубликован</span>"
                        : " <span class='label label-danger'>Неактивный</span>";
                    return $branch['category']." ".$status;
                });
            }
            ));
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return mixed
     */
    public function store()
    {
        $arrTree = json_decode(request('_order'),true);
        $this->setTree($arrTree);
        return 1;
    }

    public function create()
    {
        return redirect('admin/category/create');
    }

    private function setTree($arr,$children = 0)
    {
        foreach($arr as $key=>$arrItem){
            $menuItem = Category::find($arrItem['id']);
            $menuItem->order = $key+1;
            $menuItem->parent_id = $children;
            $menuItem->save();
            if (array_key_exists('children', $arrItem)) {
                $this->setTree($arrItem['children'],$arrItem['id']);
            }
        }
    }

    public function edit(Category $category)
    {
      return redirect()->route('admin.category.edit',$category);
    }

//    public function show(){
//        return 1;
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *

     */
    public function destroy($id,Content $content)
    {
        Category::find($id)->delete();
        return $content->withSuccess('Сообщение', 'Успешно удалено');
    }
}
