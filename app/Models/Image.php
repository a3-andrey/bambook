<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public function modifiers()
    {
        return $this->morphedByMany(Modifier::class, 'imagetable');
    }
}
