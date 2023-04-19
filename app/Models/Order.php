<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected const STATUS = [
        0 => 'Обрабатывается',
        1 => 'Собирается',
        2 => 'Отправлен',
    ];

    const DELIVERY = [
        0 => 'Доставка',
        1 => 'Самовывоз',
    ];

    const STATUS_BUYER = [
        0 => 'Физическое лицо',
        1 => 'Юридическое лицо',
    ];

    //15.11.2020
    const DATE = 'd.m.Y';

    protected $guarded=[];

    protected $casts = [
        'order' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function carts(){
        return $this->hasMany(Cart::class,'order_id');
    }

}
