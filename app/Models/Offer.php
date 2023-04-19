<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    use Sluggable;

    protected $casts = [
        'charact' => 'array'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $guarded = [];

    public function prices(){
        return $this->belongsToMany(Price::class, 'offer_price', 'offer_id', 'price_id');
    }

    public function images(){
        return $this->belongsToMany(Image::class,'image_offer','offer_id', 'image_id');

    }
}
