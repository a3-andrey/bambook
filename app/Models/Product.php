<?php

namespace App\Models;

use App\Facades\CartFacade;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Product extends Model
{

    use Sluggable;

    protected $guarded = [];

    public const priceLimitCart = [
        0 => [
            'name' => 'Цена продажи РРЦ',
            'max_limit' => 14999,
            'min_limit' => 0,
        ],
        1 => [
            'name' => 'Цена "опт"',
            'min_limit' => 15000,
            'max_limit' => 59999,
        ],
        2 => [
            'name' => 'Цена "крупный опт"',
            'min_limit' => 60000,
            'max_limit' => 99999,
        ],
         3 => [
            'name' => 'Цена "спец цена"',
            'min_limit' => 100000,
            'max_limit' => 100000000000,
        ]
    ];

    const DEFAULT_PRICE = 'Цена продажи РРЦ';

    const DEFAULT_QTU = 1;

    const DEFAULT_PRICE_SALE = 15000;

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

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('is_active', 1)
            ->where('price','>',0);
//            ->where('archived',0);
    }

    public function getPriceAttribute(){
        $price = $this->prices->where('name',self::DEFAULT_PRICE)->first();
        return  $price ? $price->price : 0 ;
    }

    public function getPriceTotalAttribute(){
        $price = $this->price;
        $totalCrt = (integer)\Cart::getTotal();
        foreach (self::priceLimitCart as $item){
            if($item['min_limit'] <= $totalCrt && $item['max_limit'] >= $totalCrt){
                $priceModel = $this->prices->where('name',$item['name'])->first();
                if($priceModel){
                    if($priceModel->price){
                        $price = $priceModel->price;
                    }
                }
            }
        }
        return $price;
    }

    public function getPriceoldAttribute(){
        $priceTotal = $this->price;
        foreach ($this->prices as $price){
            if($price->name == 'Цена продажи РРЦ'){
                $priceTotal = $price->price;
            }
        }

        return (float)$priceTotal;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }

    public function prices(){
        return $this->belongsToMany(Price::class, 'product_price', 'product_id', 'price_id');
    }

    public function images(){
        return $this->belongsToMany(Image::class,'image_product','product_id', 'image_id');
    }

    public function getImageAttribute(){
        if($image = $this->images()->first()){
            return $image->image;
        }else{
            return null;
        }
    }

    public function isSale(){
        if(\Cart::getTotal() >= self::DEFAULT_PRICE_SALE){
            return true;
        }
        return false;
    }

    public function offers(){
        return $this->hasMany(Offer::class,'offer_id','product_offer_id');
    }

    public function modifers(){
        return $this->hasMany(Modifier::class,'product_id');
    }

    public function parent(){
        return $this->belongsTo(Product::class,'parent_id');
    }
}
