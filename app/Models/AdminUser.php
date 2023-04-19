<?php

namespace App\Models;

use App\Casts\PasswordCast;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class AdminUser extends Model
{
    protected  $table = 'admin_users';

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAvatarAttribute($val)
    {

        return is_null($val) ? image(config('site.user_default_avatar')) : image($val);
    }

}
