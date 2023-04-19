<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use App\Models\Promotion;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PromotionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Промоакции';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Promotion());

        $grid->column('id', __('Id'));
//        $grid->column('products', __('Products'))->display(function ($roles) {
//            $roles = array_map(function ($role) {
//
//                $product = Product::find($role);
//                if($product){
//                    return "<span class='label label-success'>".$product->name."</span>";
//                }
//                return 'пусто';
//            }, $roles);
//
//            return join('&nbsp;', $roles);
//        });
        $grid->column('name', __('Name'));
        $grid->column('order', __('Order'));

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
        $show = new Show(Promotion::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('products', __('Products'));
        $show->field('name', __('Name'));
        $show->field('order', __('Order'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Promotion());

        $form->text('name', __('Name'));
        $form->multipleSelect('products','Products')->options(Product::all()->pluck('name','id'));
        $form->number('order', __('Order'));

        return $form;
    }
}
