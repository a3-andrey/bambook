<?php

namespace App\Traits;

use App\Facades\MoySklad_1_2_Facade;

trait MoySklad
{
    public $COMPANY_TYPE = 'individual';

    public function updateCounterparty($conterpatryID){

        if($this->delivery == 0 && $this->order == 0){

            $counterparty = MoySklad_1_2_Facade::updateConterpatry($conterpatryID,[
                'companyType' => 'individual',
                'name' => $this->lastname.' '.mb_substr($this->firstname, 0,1).'.',
                'legalFirstName' => $this->firstname,
                'legalLastName' => $this->lastname,
                'legalAddress' => $this->city.', '.$this->address,
                'email' => $this->email,
                'phone' => $this->phone,
            ]);
        }

        //Юр
        if($this->delivery == 0 && $this->order==1){
            $counterparty = MoySklad_1_2_Facade::updateConterpatry($conterpatryID,[
                'name' => $this->company,
                'companyType' => 'legal',
                'legalTitle' => $this->company,
                'inn' => $this->inn,
                'legalAddress' => $this->city.', '.$this->address,
                'email' => $this->email,
                'phone' => $this->phone,
            ]);
        }

        //Самовывоз
        if($this->delivery == 1 && $this->order==0){
            $counterparty = MoySklad_1_2_Facade::updateConterpatry($conterpatryID,[
                'companyType' => 'individual',
                'name' => $this->lastname.' '.mb_substr($this->firstname, 0,1).'.',
                'legalFirstName' => $this->firstname,
                'legalLastName' => $this->lastname,
                'email' => $this->email,
                'phone' => $this->phone,
            ]);
        }

        //Самовывоз Юр
        if($this->delivery == 1 && $this->order==1){
            $counterparty = MoySklad_1_2_Facade::updateConterpatry($conterpatryID,[
                'companyType' => 'legal',
                'name' => $this->company,
                'legalTitle' => $this->company,
                'inn' => $this->inn,
                'email' => $this->email,
                'phone' => $this->phone,
            ]);
        }
        return $counterparty;
    }

    public function createCounterparty(){
        //Физическое
        if($this->delivery == 0 && $this->order == 0){
            $counterparty = MoySklad_1_2_Facade::createCounterparty([
                'companyType' => $this->COMPANY_TYPE,
                'name' => $this->lastname.' '.mb_substr($this->firstname, 0,1).'.',
                'legalFirstName' => $this->firstname,
                'legalLastName' => $this->lastname,
                'legalAddress' => $this->city.', '.$this->address,
                'email' => $this->email,
                'phone' => $this->phone,
            ]);
        }

        //Юр
        if($this->delivery == 0 && $this->order==1){
            $counterparty = MoySklad_1_2_Facade::createCounterparty([
                'companyType' => $this->COMPANY_TYPE,
                'name' => $this->company,
                'inn' => $this->inn,
                'legalAddress' => $this->city.', '.$this->address,
                'email' => $this->email,
                'phone' => $this->phone,
            ]);
        }

        //Самовывоз
        if($this->delivery == 1){
            $counterparty = MoySklad_1_2_Facade::createCounterparty([
                'companyType' => $this->COMPANY_TYPE,
                'name' => $this->lastname.' '.mb_substr($this->firstname, 0,1).'.',
                'legalFirstName' => $this->firstname,
                'legalLastName' => $this->lastname,
                'email' => $this->email,
                'phone' => $this->phone,
            ]);
        }

        return $counterparty;
    }


//    public function createCounterparty(array $data){
//
//        $ms = new \Evgeek\Moysklad\MoySklad(
//            [config('moy_sklad.login'), config('moy_sklad.password')],
//            \Evgeek\Moysklad\Enums\Format::OBJECT ,
//            new \Evgeek\Moysklad\Http\GuzzleSender()
//        );
//
//        return $ms->endpoint('entity')
//                ->method('counterparty')
//                ->create($data);
//    }
//
//    public function organization(){
//        $ms = new \Evgeek\Moysklad\MoySklad(
//            [config('moy_sklad.login'), config('moy_sklad.password')],
//            \Evgeek\Moysklad\Enums\Format::OBJECT ,
//            new \Evgeek\Moysklad\Http\GuzzleSender()
//        );
//
//        $responece = $ms->endpoint('entity')
//            ->method('organization')
//            ->send('GET');
//        return $responece->rows[0];
//    }
//
//    public function customer($counterparty,$organization){
//        $ms = new \Evgeek\Moysklad\MoySklad(
//            [config('moy_sklad.login'), config('moy_sklad.password')],
//            \Evgeek\Moysklad\Enums\Format::OBJECT ,
//            new \Evgeek\Moysklad\Http\GuzzleSender()
//        );
//        $ms->endpoint('entity')
//            ->method('customerorder')
//            ->create([
//                'organization' => $organization,
//                'agent' => $counterparty
//            ]);
//    }
//
//    public function getSingleAssortment(Product $productM){
//        $ms = new \Evgeek\Moysklad\MoySklad(
//            [config('moy_sklad.login'), config('moy_sklad.password')],
//            \Evgeek\Moysklad\Enums\Format::OBJECT ,
//            new \Evgeek\Moysklad\Http\GuzzleSender()
//        );
//        $product = $ms->entity()->product()->limit(1);
//        $product = $product->filter(
//            (new \Evgeek\Moysklad\Filter())
//                ->eq('name', $productM->name)
//        );
//        $products = $product->get();
//        return Arr::get($products->rows,0);
//    }


}
