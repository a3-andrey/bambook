<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminConfigModel extends Model
{
    protected $fillable = ['name', 'value'];

    protected $table = 'admin_config';
}
