<?php

namespace App\Traits;

use App\Facades\MoySklad_1_2_Facade;
use App\Models\Category;
use App\Models\Characteristic;
use App\Models\Price;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

trait MoySkladParserTrait
{
    public function getParentCategory($category){

        if($category->pathName != ''){
            $catExplode = explode('/',$category->pathName);
            $catExplodeReserve = array_reverse($catExplode);
            $categoryParent = Category::updateOrCreate([
                'category' => Arr::get($catExplodeReserve,0),
            ],[
                'mark' => 1
            ]);
            return $categoryParent?$categoryParent->id:null;
        }
        return null;
    }

    /**
     * @param Model $model
     * @param string $row
     * return void
     */
    public function mark(Model $model,$row='mark'){
        foreach ($model::all() as $item){
            $item->$row = 0;
            $item->save();
        }
    }

    /**
     * @param Model $model
     * @param string $row
     * return void
     */
    public function markTrash(Model $model,$row='mark'){
        $model->where($row,0)->update([
            'is_active' => 0
        ]);
    }

    public function storePrices($prices,Model $model){
        $pricesCollect = collect();
        foreach ($prices as $price){
            $price = Price::updateOrCreate([
                'name' => $price->priceType->name,
                'price' => intToFloat($price->value),
                'external_id' => $price->priceType->externalCode,
            ]);
            $pricesCollect[] = $price;
        }

        $model->prices()->detach();

        $model->prices()->attach($pricesCollect->pluck('id')->toArray());
    }

    public function getAssortmentCharacteristics(){
        $charArr = [];

        if(isset($assortmentItem->characteristics)){
            foreach($assortmentItem->characteristics as $char){
                $charArr[$char->name] = $char->value;
            }
        }

        return $charArr;
    }

    public function downloadImage($href){
        $images = [];
        if(isset($href)){
            foreach (MoySklad_1_2_Facade::getImage($href) as $image){
                $images[] = $image->id;
            }
            return $images;
        }

        return $images;
    }

    public function getCategoryPathName($pathName){
        $categories = [];
        $explodeCategories = $this->hydrateCategories($pathName);
        foreach ($explodeCategories as $exCategory){
            $cat = Category::where('category',$exCategory)->first();
            if($cat){
                $categories[] = $cat->id;
            }
        }
        return $categories;
    }

    public function storeCharacteristics($characteristics){
        $chArr = collect();
        foreach ($characteristics as $characteristic){
            $ch = Characteristic::updateOrCreate([
                'name' => $characteristic->name,
                'value' => $characteristic->value,
                'external_id' => $characteristic->id,
            ],[
                'name' => $characteristic->name,
                'value' => $characteristic->value,
                'external_id' => $characteristic->id,
            ]);
            $chArr[] = $ch;
        }
        return $chArr;
    }


    public function hydrateCategories(string $pathName){
        $explode = explode("/", $pathName);
        if(is_array($explode)){
            return $explode;
        }
        return [];
    }

}
