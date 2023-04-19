<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Storage;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Продукция';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());
        $grid->column('id', __('id'))->sortable();
        $grid->column('name', __('Name'))->filter('like');
        $grid->column('multiple', __('Кратность'))->editable();
        $grid->column('description', __('Описание'));
        $grid->column('image', __('Картинка'))->display(function ($val){
            $val = Storage::url($val);
            return "<img width='100' src='{$val}'>";
        });

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product());

        $form->text('name', __('Name'));
        $form->text('multiple', __('Кратность'));
        $form->text('description', __('Description'));

        return $form;
    }
}
