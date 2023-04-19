<?php

namespace App\Admin\Controllers;

use App\Models\Code;
use App\Models\Counter;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Arr;

class CounterController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Счетчики';

    protected $states = [
            'on'  => ['value' => 1, 'text' => 'активный', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'выключен', 'color' => 'danger'],
            ];

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Counter());

        $grid->column('name', __('Name'));

        $grid->column('position', __('Положение'))->display(function($val){
           $val =  Arr::get(Counter::getPosition(),$val);
           return is_array($val) ? 'не назначено' : $val;
        });

        $grid->column('status', __('Статус'))->bool();

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
        $show = new Show(Counter::findOrFail($id));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Counter());

        $form->text('name', __('Name'));

        $form->switch('status', __('Статус'))
            ->states($this->states)
            ->default(1);
//
        $form->js('counters', __('Контент'));
//
        $form->select('position', __('Положение'))
            ->options(Counter::getPosition());

        return $form;
    }
}
