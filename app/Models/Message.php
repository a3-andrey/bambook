<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function getCreatedAtAttribute($val){

        return \Carbon\Carbon::parse($val)
            ->timezone('Europe/Moscow')
            ->format('H:m d.m.Y');
    }
}
