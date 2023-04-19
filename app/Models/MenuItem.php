<?php

namespace App\Models;

use App\Scopes\MenuItemScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $casts = [
        'parent_id'=>'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new MenuItemScope());
    }

    public function parents() {
        return $this->hasMany(MenuItem::class,'parent_id','id') ;
    }

    public function getChildAttribute(){
        return $this->belongsTo(MenuItem::class, 'id', 'parent_id');
    }
}
