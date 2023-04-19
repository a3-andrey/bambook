<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\MenuAction;
use App\Models\Menu;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MenuController extends AdminController
{

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Меню';

    protected $description = 'Создание меню для сайта';
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Menu());
        $grid->disableExport();
        $grid->disableFilter();
        $grid->disableTools();
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->column('name')->editable();
        $grid->released('Создать меню')->display(function ($released) {
            return '
           <div style="    float: left;">  
            <div class="btn-group pull-right grid-create-btn" style="margin-right: 10px">
                <a href="'.url("admin/menu/{$this->id}").'" class="btn btn-sm btn-primary" title="Добавить">
                    <i class="fa fa-plus"></i><span class="hidden-xs">&nbsp;&nbsp;Редактировать</span>
                </a>
            </div>
        </div>';
        });

        $grid->column('Вывод','Вывод')->display(function ($released) {
            return "<p>Menu::get('{$this->slug}')</p>";
        });

        $grid->actions(function ($actions) {
            $actions->disableEdit();
            $actions->disableView();
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
        $show = new Show(Menu::findOrFail($id));
        $show->field('name', 'Наименование');
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Menu());
        $form->text('name', 'Наименование');
        return $form;
    }
}
