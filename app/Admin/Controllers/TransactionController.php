<?php

namespace App\Admin\Controllers;

use App\Models\Slider;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TransactionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Пополнения';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Transaction());
        $grid->model()
            ->whereNull('type_wallet')
            ->whereNotNull('hash')->orderBy('id','desc');
        $grid->disableCreateButton();
        $grid->disableFilter();
        $grid->disableRowSelector();
        $grid->disableActions();
        $grid->disableColumnSelector();
        $grid->column('id', __('Id'));
        $grid->column('date_fill', __('Дата пополнения'));
        $grid->column('hash', __('Хэш'));
        $grid->column('summa', __('Сумма'));
        $grid->column('user_id', __('Пользователь'))->display(function ($val){
            $user = User::find($val);
            $name = '';
            $email = '';
            if($user){
                $name = $user->full_name;
                $email = $user->email;
            }
            return "<a>{$name} - {$email}</a>";
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


}
