<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

//    protected $casts = [
//        'products' => 'array',
//    ];

    public function products()
    {
        return $this->belongsToMany(Product::class,'promotion_product');
    }
}
