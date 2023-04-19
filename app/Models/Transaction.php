<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $casts = [
        'date_fill' => 'date:d.m.Y',
        'hash' => 'string',
        'summa' => 'double',
        'wallet' => 'string',
        'type_wallet' => 'string',
        'user_id' => 'integer',
    ];

    protected $guarded = [];

    public const TYPE_WALLET = [
        0 => 'Сеть ERC-20',
        1 => 'Сеть TRC-20',
    ];
}
