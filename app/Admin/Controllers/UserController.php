<?php

namespace App\Admin\Controllers;

use App\Mail\UserPassword;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Пользователи';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('firstname', __('Имя'));
        $grid->column('lastname', __('Фамилия'));
        $grid->column('patronymic', __('Отчество'));
        $grid->column('email', __('Email'));

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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        $show->field('remember_token', __('Remember token'));
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
        $form = new Form(new User());

        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = Hash::make($form->password);
            }
        });

        $form->column(6, function ($form) {
            $form->text('firstname', __('Имя'))->rules('required');
            $form->text('lastname', __('Фамилия'))->rules('required');
            $form->text('patronymic', __('Отчество'))->rules('required');
            $form->text('phone', __('Телефон'))->rules('required');
            $form->email('email', __('Email'))->rules('required');


//            $password = empty($form->model()->password) ? $form->model()->generatePassword() : $form->model()->password;

            $form->text('password', 'Пароль')
                ->rules('required|confirmed')
                ->default(function ($form)  {
                    $password = empty($form->model()->password) ? $form->model()->generatePassword() : $form->model()->password;
                    return $password;
                });

            $form->text('password_confirmation', trans('admin.password_confirmation'))
                ->rules('required')
                ->default(function ($form)  {
                    return $form->model()->password;
                });

            $form->ignore(['password_confirmation']);
        });

        $form->column(6, function ($form) {
            $form->image('avatar', __('Аватарка пользователя'))->rules('required');
            $form->text('country', __('Страна'))->rules('required');
            $form->text('city', __('Город'))->rules('required');
            $states = [
                'on'  => ['value' => 1, 'text' => 'Активный', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => 'Гость', 'color' => 'danger'],
            ];

            $form->switch('active','Статус')->states($states)->default(1);
        });


        $form->column(12, function ($form) {
            $form->embeds('profile','Профиль клиента', function ($form) {
                foreach (User::PROFILE as $key=>$val){
                    if($val['type_admin'] == 'select'){
                        $form->select($key,$val['name'])
                            ->options($val['type_admin_value']);
                    }else{
                        $type = $val['type_admin'];
                        $form->$type($key,$val['name']);
                    }
                }
            });
        });

        return $form;
    }
}
