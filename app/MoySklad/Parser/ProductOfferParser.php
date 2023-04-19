<?php

namespace App\MoySklad\Parser;

use App\Models\Category;
use App\Models\Offer;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Support\Arr;

class ProductOfferParser
{
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//       $this->storeCategory();
//
//       $this->storeAssortment();

//        $this->storeProducts();

        $mods = MoySklad::getModifiers();
        foreach ($mods as $mod){
            dd($mod);
        }

    }

    private function storeCategory(){
        $this->categories = MoySklad::getCategory();
        $this->markCategory();
        foreach($this->categories as $category){
            $categoryModel = Category::where('category', $category->name)->first();
            if(empty($categoryModel)){
                $categoryModel = new Category();
            }
            $categoryModel->category =  $category->name;
            $categoryModel->parent_id = $this->getParentCategory($category);
            $categoryModel->mark = 1;
            $categoryModel->save();
        }
        $this->markCategoryTrash();
    }

    private function getParentCategory($category){
        if($category->pathName != ''){
            $catExplode = explode('/',$category->pathName);
            $catExplodeReserve = array_reverse($catExplode);
            $categoryParent = Category::updateOrCreate([
                'category' => Arr::get($catExplodeReserve,0)
            ]);

            return $categoryParent?$categoryParent->id:null;
        }
        return null;
    }

    //Отмечаем все категории,чтобы выявить,что могли удалить из моего склада
    private function markCategory(){
        foreach (Category::all() as $item){
            $item->mark = 0;
            $item->save();
        }
    }

    //Удаляем категории,которые не отмечены
    private function markCategoryTrash(){
        Category::where('mark',0)->delete();
    }

    protected function storeAssortment(){
        $this->assortment = MoySklad::getAssortment();
        foreach (Offer::all() as $item){
            $item->mark = 1;
            $item->save();
        }
        foreach ($this->assortment as $assortmentItem){

            if(isset($assortmentItem->name)){

                var_dump($assortmentItem->name);

                $charArr = [];
                if(isset($assortmentItem->characteristics)){
                    foreach($assortmentItem->characteristics as $char){
                        $charArr[$char->name] = $char->value;
                    }
                }

                $offerModel = Offer::updateOrCreate(
                    ['offer_id' => $assortmentItem->id],
                    [
                        'offer_id' => $assortmentItem->id,
                        'updated' => $assortmentItem->updated,
                        'name' => $assortmentItem->name,
                        'description' => isset($assortmentItem->description)?$assortmentItem->description:null,
                        'code' => isset($assortmentItem->code)?$assortmentItem->code:null,
                        'archived' => $assortmentItem->archived,
                        'quantity' => isset($assortmentItem->quantity)?$assortmentItem->quantity:0,
                        'charact' => isset($assortmentItem->characteristics) ? json_encode($charArr) : null
                    ]
                );

                //Цены
                foreach ($assortmentItem->salePrices as $price){
                    $price = Price::updateOrCreate([
                        'name' => $price->priceType->name,
                        'price' => intToFloat($price->value),
                        'external_id' => $price->priceType->externalCode,
                    ]);

                    //Цена - продукт
                    \Illuminate\Support\Facades\DB::table('offer_price')->updateOrInsert([
                        'offer_id' => $offerModel->id,
                        'price_id' => $price->id,
                    ]);
                }
                // Добавляем картинки. Добавить функционал, если удалили картинку
                if(isset($assortmentItem->images->meta->href)){
                    $offerModel->images()->detach();
                    foreach (MoySklad::getImage($assortmentItem->images->meta->href) as $image){
                        $offerModel->images()->attach($image);
                    }
                }
            }

        }
        Offer::where('mark',0)->delete();
    }


    private function storeProducts(){
        foreach (Product::all() as $item){
            $item->mark = 0;
            $item->save();
        }
        foreach (MoySklad::getProducts() as $product){
            $offers = Offer::where('offer_id',$product->id)->get();

            if($offers && $offers->count() > 0){
                foreach ($offers as $offer){
                    $productModel =  Product::updateOrCreate([
                        'name' => $offer->name,
                    ],[
                        'product_offer_id' => $product->id,
                        'description' => empty($offer->description) ? isset($product->description)?:null : $offer->description,
                        'code' => isset($offer->code)?:null,
                        'archived' => $offer->archived,
                        'price'=> isset($product->price)?:null,
                        'mark' => 1,
                    ]);

                    $productModel->prices()->detach();
                    foreach ($offer->prices as $price){
                        $productModel->prices()->attach($price);
                    }

                    //Добавляем категории
                    if($product->pathName){
                        $explodeCategoryArray = $this->hydrateCategories($product->pathName);
                        if(count($explodeCategoryArray) > 0){
                            $productModel->categories()->detach();
                            foreach ($explodeCategoryArray as $item){
                                $cat = Category::where('category',$item)->first();
                                if($cat){
                                    $productModel->categories()->attach($cat);
                                }
                            }
                        }
                    }

                }
            }else{
                $productModel = Product::updateOrCreate([
                    'name' => $product->name
                ],[
                    'product_offer_id' => $product->id,
                    'description' => isset($product->description)?$product->description:null,
                    'code' => isset($product->code)?$product->code:null,
                    'archived' => $product->archived,
                    'price' => intToFloat($product->minPrice->value),
                    'mark' => 1,
                ]);
                //Цены
                $productModel->prices()->detach();

                foreach ($product->salePrices as $price){
                    $priceModel = Price::updateOrCreate([
                        'name' => $price->priceType->name,
                        'price' => intToFloat($price->value),
                        'external_id' => $price->priceType->id
                    ]);
                    $productModel->prices()->attach($priceModel);
                }

                //Добавляем категории
                if($product->pathName){
                    $explodeCategoryArray = $this->hydrateCategories($product->pathName);
                    if(count($explodeCategoryArray) > 0){
                        $productModel->categories()->detach();
                        foreach ($explodeCategoryArray as $item){
                            $cat = Category::where('category',$item)->first();
                            if($cat){
                                $productModel->categories()->attach($cat);
                            }
                        }
                    }
                }
            }



            foreach (MoySklad::getImage($product->images->meta->href) as $image){
                $productModel->images()->detach();
                $productModel->images()->attach($image);
            }



            var_dump($productModel->name);

        }
        Product::where('mark',0)->delete();
    }

    /**

     * @param string $pathName
     * @return array|false|string[]
     */
    private function hydrateCategories(string $pathName){
        $explode = explode("/", $pathName);
        if(is_array($explode)){
            return $explode;
        }
        return [];
    }
}
