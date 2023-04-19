<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Collapse;
use Encore\Admin\Widgets\Form;
use Encore\Admin\Widgets\InfoBox;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Главная')
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $infoBox = new InfoBox('Кол-во пользоватлей', 'users', 'aqua', '/admin/users', User::all()->count());
                    $column->append($infoBox->render());
                });

            });
    }



}
