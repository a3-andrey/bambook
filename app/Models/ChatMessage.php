<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChatMessage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const GUARD = [
        'web' => [
            'name' => 'web'
        ],
        'admin' => [
            'name' => 'admin'
        ]
    ];



    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function admin_user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
