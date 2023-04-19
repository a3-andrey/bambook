<?php

namespace App\Admin\Controllers;

use App\Models\Contacts;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ContactController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Страница "Контакты"';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Contacts());

        $grid->column('id', __('id'));
        $grid->column('title', __('Заголовок'));
        $grid->column('description', __('Текст'));

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
        $show = new Show(Contacts::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Contacts());

        $form->text('title', __('Заголовок'));
        $form->textarea('description', __('Текст'));

        return $form;
    }
}
