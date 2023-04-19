<?php
namespace App\Services;
use App\Facades\MoySklad_1_2_Facade;
use App\Facades\MoySkladOrderFacade;
use App\Models\Modifier;
use Illuminate\Support\Arr;
use PHPUnit\Framework\Error\Error;

class MoySkladOrderService
{
    public $counterparty;
    public $assortments = [];
    public $products;
    public $ms;

//    public function __construct(){
//        $this->ms = new \Evgeek\Moysklad\MoySklad(
//            [config('moy_sklad.login'), config('moy_sklad.password')],
//            \Evgeek\Moysklad\Enums\Format::OBJECT ,
//            new \Evgeek\Moysklad\Http\GuzzleSender()
//        );
//    }

//    public function searchCounterparty($email){
//         $responce = $this->ms->endpoint('entity')
//            ->method('counterparty')
//            ->filter(
//                (new \Evgeek\Moysklad\Filter())
//                    ->eq('email', $email)
//            )
//            ->limit(1)
//            ->send('GET');
//
//         if(count($responce->rows)){
//            return  $this->counterparty = $responce->rows[0];
//         }
//        return false;
//    }

//    public function createRegisterCounterparty($data){
//        //        Ищем Контрагента
//        $counterpartiesSearch = MoySklad_1_2_Facade::searchCounterparty($data['email']);
//
//        if($counterpartiesSearch && count($counterpartiesSearch->rows) != 0){
//            $this->counterparty = $counterpartiesSearch->rows[0];
//        }else{
//            $counterparty = $this->createCounterparty([
//                'companyType' => 'individual',
//                'name' => $data['lastname'].' '.mb_substr($data['firstname'], 0,1).'.',
//                'description' => 'Создан при регистрации на сайте '.url('/'),
//                'legalFirstName' => $data['firstname'],
//                'legalLastName' => $data['lastname'],
//                'legalAddress' => $data['country'].', '.$data['city'].', '.$data['address'],
//                'email' => $data['email'],
//                'phone' => $data['phone'],
//            ]);
//            $this->counterparty =  $counterparty;
//        }
//
//        return  $this->counterparty;
//    }

    public function createCounterparty(array $data){

         return  $this->counterparty;
    }

    public function createOrganization(){
        $ms = new \Evgeek\Moysklad\MoySklad(
            [config('moy_sklad.login'), config('moy_sklad.password')],
            \Evgeek\Moysklad\Enums\Format::OBJECT ,
            new \Evgeek\Moysklad\Http\GuzzleSender()
        );

        $responece = $ms->endpoint('entity')
            ->method('organization')
            ->send('GET');
        return $responece->rows[0];
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
                "price"=> $productM->priceTotal*100,
                "discount"=> 0,
                "vat" => 0,
                'assortment' => [
                    'meta' => $meta
                ]
            ];
        }
    }

    public function createOrder($id,$code){

        $this->ms->endpoint('entity')
            ->method('customerorder')
            ->create([
//                'id' => $id,
                'code' => (string)$code,
                'organization'=>$this->createOrganization(),
                'agent' => $this->counterparty,
                'positions' => $this->assortments
            ]);
    }


}
