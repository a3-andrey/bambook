<?php

namespace App\Admin\Controllers;

use App\Models\Quiz;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class QuizController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Тест';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Quiz());

        $grid->column('question', __('Вопрос'));
//        $grid->column('variants', __('Варианты'));
        $grid->column('active', __('Учитывать'));
//        $grid->column('image', __('Изображение'));
//        $grid->column('images', __('Изображения'));


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
        $show = new Show(Quiz::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('question', __('Question'));
        $show->field('variants', __('Variants'));
        $show->field('image', __('Image'));
        $show->field('images', __('Images'));
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
        $form = new Form(new Quiz());

        $form->textarea('question', __('Вопрос'));
        $form->table('variants','Варианты', function ($table) {
            $table->text('variant','Текст вопроса');
            $table->text('value','Вес вопроса');
        });

        $states = [
            'on'  => ['value' => 1, 'text' => 'учитывать', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'не учитывать', 'color' => 'danger'],
        ];

        $form->switch('active','Учитывать')->states($states)->default(1);
//        $form->image('image', __('Image'));
//        $form->textarea('images', __('Images'));

        return $form;
    }
}
