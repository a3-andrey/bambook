<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Menu extends Model
{
    use HasFactory;
    use Sluggable;

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

    public function menus()
    {
        return $this->hasMany(MenuItem::class, 'menu_id', 'id');
    }

    public function parents()
    {
        return $this->hasMany(MenuItem::class, 'menu_id', 'id')->where('parent_id',0);
    }

}
