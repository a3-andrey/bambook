<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;


class Contact extends Model
{
    use Sluggable;

    protected $casts = [
        'contact' =>'json',
    ];

    public $fillable = [
        'contact',
        'name',
        'attribute',
        'image',
        'slug',
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
                'source' => 'title'
            ]
        ];
    }

}
