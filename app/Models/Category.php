<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Encore\Admin\Traits\ModelTree;
use Encore\Admin\Tree;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

use Illuminate\Support\Facades\Request;

class Category extends Model implements Sortable
{
    //
    use ModelTree,AdminBuilder,SortableTrait;

    protected $guarded = [];

    use Sluggable;

    public $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];

    protected $casts = [
        'intersections' => 'array',
        'order_column' => 'integer'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function (Model $branch) {
            $parentColumn = $branch->getParentColumn();

//            if (Request::has($parentColumn) && Request::input($parentColumn) == $branch->getKey()) {
//                throw new \Exception(trans('admin.parent_select_error'));
//            }

            if (Request::has('_order')) {
                $order = Request::input('_order');

                Request::offsetUnset('_order');

                (new Tree(new static()))->saveOrder($order);

                return false;
            }

            return $branch;
        });
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'category'
            ]
        ];
    }

    public function parent()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function child(){
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function scopeFirstChildren($query){
        return $query->where('parent_id', 0);
    }

   public function products()
   {
       return $this->belongsToMany(Product::class, 'product_category');
   }

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('is_active', 1);

    }





}
