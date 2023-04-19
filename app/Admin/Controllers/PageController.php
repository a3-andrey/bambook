<?php

namespace App\Admin\Controllers;

use App\Models\Page;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Страницы';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Page());
        $grid->column('id', __('Идетификатор'));
        $grid->column('title', __('Title'));
        $grid->column('link', 'Ссылка')->display(function (){
            return "<a target='_blank' href='".$this->uri."'>".$this->uri."</a>";
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
        $show = new Show(Page::findOrFail($id));

        $show->field('id', __('Id'));


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Page());

        $form->text('meta_title', __('meta title'));
        $form->textarea('meta_description', __('meta description'));
        $form->textarea('meta_keywords', __('meta keywords'));
        $form->text('uri', 'Ссылка');
        $form->textarea('title', __('Title'));

        $form->ckeditor('content', __('Content'));

//        $form->multipleImage('images', __('Images'))->sortable()->removable();

        $form->text('template', 'Шаблон')->help('Подключить представление из view/public');



        $states = [
            'on'  => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
        ];

//        $form->switch('content', __('Content'))->states($states);
        return $form;
    }
}
