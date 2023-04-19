<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Категории';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category());
        $parents = \App\Models\Category::where('category','Bamboo-hookah')->first()->parent->pluck('id')->toArray();
        $grid->model()->whereIn('id',$parents)->orderBy('order_column','ASC');
        $grid->column('id','id');
        $grid->column('category','Категория');
        $grid->column('order_column','Сортировка')->editable();
//        $grid->sortable();
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Category::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Category());

        $form->multipleSelect('intersections','Сопуствующие категории')
            ->options(Category::all()->pluck('category','id')->toArray());
        $form->text('order_column');
        return $form;
    }
}
