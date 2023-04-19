<?php

namespace App\Services;

use App\Facades\MoySklad_1_2_Facade;
use App\Models\Category;
use App\Models\Log;
use App\Models\Modifier;
use App\Models\Offer;
use App\Models\Product;
use App\Traits\MoySkladParserTrait;
use Illuminate\Support\Carbon;

class MoySkladParserService
{
    use MoySkladParserTrait;

    public $ms;

    public function storeProducts($log){

        $this->mark(new Product());

        foreach(MoySklad_1_2_Facade::getProducts() as $key=>$product){

        $productModel = Product::updateOrCreate([
            'name' => $product->name
        ],[
            'product_offer_id' => $product->id,
            'description' => isset($product->description)?$product->description:null,
            'code' => isset($product->code)?$product->code:null,
            'archived' => $product->archived,
            'price' => intToFloat($product->minPrice->value),
            'mark' => 1,
            'is_active' => 1,
        ]);

        if(isset($product->salePrices)){
            $this->storePrices($product->salePrices,$productModel);
        }

        if(isset($product->pathName) && $product->pathName){
                $categories = $this->getCategoryPathName($product->pathName);
                $productModel->categories()->detach();
                $productModel->categories()->attach($categories);
            }

            if(isset($product->images->meta->href)){
                $images = $this->downloadImage($product->images->meta->href);
                $productModel->images()->detach();
                $productModel->images()->attach($images);
            }

            $log->record += 1;
            $log->save();
//            usleep(550000);
//            var_dump($product->name);
        }

        $this->markTrash(new Category());

    }

    public function storeModifiers(){

        $this->mark(new Modifier());

        foreach(MoySklad_1_2_Facade::getModifiers() as $modifier){

            $product = MoySklad_1_2_Facade::getProduct($modifier->product);

            $productM = Product::where('product_offer_id',$product->id)->first();

            $modifierM = Modifier::updateOrCreate([
                'name' => $modifier->name
            ],[
                'mark' => 1,
                'is_active' => 1,
                'accountId' => $modifier->accountId,
                'external_id' => $modifier->id,
                'code' => $modifier->code,
                'externalCode' => $modifier->externalCode,
                'product_id' => $productM->id,
                'archived' => $modifier->archived,
            ]);

            if(isset($modifier->salePrices)){
                $this->storePrices($modifier->salePrices,$modifierM);
            }

            if(isset($modifier->characteristics)){
                $characteristics = $this->storeCharacteristics($modifier->characteristics);
                $modifierM->characteristics()->detach();
                $modifierM->characteristics()->attach($characteristics->pluck('id')->toArray());
            }

            if(isset($modifier->images)){
                $images = $this->downloadImage($modifier->images->meta->href);
                $modifierM->images()->detach();
                $modifierM->images()->attach($images);
            }

            var_dump($modifier->name);

        }

        $this->markTrash(new Modifier());

//        foreach (Product::where('parent_id','!=',0)->get() as $item){
//            $item->mark = 0;
//            $item->save();
//        }

        foreach (Product::where('parent_id',0)->get() as $product){
            foreach ($product->modifers as $modifer){
                $productModel = Product::updateOrCreate([
                    'name' => $modifer->name,
                    'code' => $modifer->code,
                ],[
                    'parent_id' => $product->id,
                    'product_offer_id' => $modifer->id,
                    'is_active' => $modifer->is_active,
                    'price' => $product->price,
                    'description' => $product->description,
                    'archived' => $modifer->archived,
                ]);

                $productModel->categories()->detach();
                $productModel->categories()->attach($product->categories);

                $productModel->images()->detach();
                $productModel->images()->attach($modifer->images);

                $productModel->prices()->detach();
                $productModel->prices()->attach($modifer->prices);
            }
        }

        $this->markTrash(new Product());

        var_dump('good');

    }

    public function storeCategory(){

        $this->mark(new Category());
        foreach(MoySklad_1_2_Facade::getCategories() as $category){

            $categoryModel = Category::updateOrCreate([
                'category'=> $category->name,
            ],[
                'mark' => 1
            ]);

            if(isset($category->productFolder) && $category->productFolder){
                $parentCategory = MoySklad_1_2_Facade::getClient($category->productFolder->meta->href);

                $categoryModelParent = Category::updateOrCreate([
                    'category'=> $parentCategory->name,
                ],[
                    'mark' => 1
                ]);


                $categoryModel->parent_id = $categoryModelParent->id;
                $categoryModel->save();
            }

        }

        $this->markTrash(new Category());
    }

    public function storeAssortment(){
        foreach (MoySklad_1_2_Facade::getAssortments() as $assortmentItem){

            $offerModel = Offer::updateOrCreate(
                ['offer_id' => $assortmentItem->id],
                [
                    'updated' => $assortmentItem->updated,
                    'name' => $assortmentItem->name,
                    'description' => isset($assortmentItem->description)?$assortmentItem->description:null,
                    'code' => isset($assortmentItem->code)?$assortmentItem->code:null,
                    'archived' => $assortmentItem->archived,
                    'quantity' => isset($assortmentItem->quantity)?$assortmentItem->quantity:0,
                    'charact' => $this->getAssortmentCharacteristics(),
                ]
            );

            $this->storePrices($assortmentItem->salePrices,$offerModel);

            if(isset($assortmentItem->images->meta->href)){
                $images = $this->downloadImage($assortmentItem->images->meta->href);
                $offerModel->images()->detach();
                $offerModel->images()->attach($images);
            }
        }
    }
}
