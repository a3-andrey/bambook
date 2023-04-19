<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modifier extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function characteristics(){
        return $this->belongsToMany(Characteristic::class,'modifier_characteristic','modifier_id','characteristic_id');
    }

    public function images(){
        return $this->morphToMany(Image::class,'imagetable');
    }

    public function prices(){
        return $this->belongsToMany(Price::class, 'modifier_price', 'modifier_id', 'price_id');
    }
}
