<?php

namespace App\Models;

use App\Casts\PasswordCast;
use App\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded=[];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Отправить пользователю уведомление о сбросе пароля.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token,$this->email));
    }

    public function generatePassword(){
        return Str::random(8);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function delivery(){
        return $this->hasOne(Delivery::class);
    }

    public function orders(){
        return $this->hasMany(Order::class,'user_id');
    }

}
