<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class Tree extends Controller
{
    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('Пользователи');
            $content->body(User::tree(function ($tree) {
                $tree->branch(function ($branch) {
                    $status_success = '<span style="margin-left: 20px;" class="label label-success">Подтвержден</span>';
                    $status_danger = '<span style="margin-left: 20px;" class="label label-danger">Гость</span>';
                    $package = '<span style="margin-left: 20px;" class="label label-primary">'.$branch['package'].'</span>';
                    $src = Arr::get($branch,'avatar') ? Arr::get($branch,'avatar') : Storage::url(config('site.user_default_avatar'));
                    $status = $branch['active'] == 1?$status_success:$status_danger;
                    $logo = "<img src='$src' style='margin-left:10px;max-width:30px;max-height:30px' class='img'/>";
                    return "{$branch['id']} - ".$branch['firstname'].' '.$branch['lastname'].' '.$branch['patronymic']."  $logo $status $package";
                });
            }
            ));
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return mixed
     */
    public function store()
    {
        $arrTree = json_decode(request('_order'),true);
        $this->setTree($arrTree);
        return 1;
    }

    public function create()
    {
        return redirect('admin/users/create');
    }

    private function setTree($arr,$children = 0)
    {
        foreach($arr as $key=>$arrItem){
            $menuItem = User::find($arrItem['id']);
            $menuItem->order = $key+1;
            $menuItem->parent_id = $children;
            $menuItem->save();
            if (array_key_exists('children', $arrItem)) {
                $this->setTree($arrItem['children'],$arrItem['id']);
            }
        }
    }

    public function edit($user)
    {
        return redirect("admin/users/".$user."/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User::find($id)->delete();
    }
}
