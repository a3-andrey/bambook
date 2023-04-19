<?php

namespace App\MoySklad\Components;

use App\Facades\MoySklad_1_2_Facade;
use App\Models\Modifier;

class CustomerOrder
{
    public $id;

    public $name;

    public $code;

    protected $ms;

    protected $organization;

    protected $counterparty;

    protected $assortments;

    public $description='';

    public function __construct($ms){
        $this->ms = $ms;
        $this->organization = MoySklad_1_2_Facade::getOrganization();
    }

    public function setCounterparty($counterparty){
        $this->counterparty = $counterparty;
        return $this;
    }

    public function setOrganization($organozation){
        $this->organization= $organozation;
        return $this;
    }

    public function pushAssortment($item){

        $productM = $item->associatedModel;

        $meta = null;
        //Переписапть
        if($productM->parent){
            $parent = Modifier::where('name',$productM->name)->first();

            $modifer = MoySklad_1_2_Facade::getModifier($parent->external_id);

            $modifer?$meta = $modifer->meta:null;
        }else{
            $product = $this->ms->endpoint('entity')
                ->method('product')
                ->byId($productM->product_offer_id)
                ->send('GET');
            $product?$meta = $product->meta:null;
        }
        if($meta!==null){
            $this->assortments[] = [
                'quantity'=> $item->quantity,
                "price"=> $item->price*100,
                "discount"=> 0,
                "vat" => 0,
                'assortment' => [
                    'meta' => $meta
                ]
            ];
        }
    }

    public function sendOrder(){
        $this->ms->endpoint('entity')
            ->method('customerorder')
            ->create([
                'name' =>  $this->name,
                'organization' => $this->organization,
                'agent' => $this->counterparty,
                'positions' => $this->assortments,
                'description' => $this->description
            ]);
    }
}
