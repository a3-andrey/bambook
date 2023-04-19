<?php

namespace App\Admin\Controllers;

use App\Models\Slider;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SliderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Слайдеры';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Slider());

        $grid->column('name', __('Слайдер'));
        $grid->column('output', __('Вывод'))->display(function ($val){
            return 'Slider::get('.$this->id.')';
        });

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
        $show = new Show(Slider::findOrFail($id));





        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Slider());

        $form->text('name', __('Подзаголовок'));

        // Subtable fields
        $form->hasMany('sliders','Слайды', function (Form\NestedForm $form) {
            $form->image('image', __('Слайд'));
            $form->text('sub_title', __('Подзаголовок'));
            $form->text('title', __('Заголовок'));
            $form->textarea('description', __('Текст слайда'));
            $form->text('button', __('Текст кнопки'));
            $form->text('btn_action', __('Ссылка кнопки'));
        });

        return $form;
    }
}
