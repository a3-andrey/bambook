<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    //
    public function __invoke(){
        //С подробностями
        $ms = new \Evgeek\Moysklad\MoySklad(
           [config('moy_sklad.login'), config('moy_sklad.password')],
            \Evgeek\Moysklad\Enums\Format::OBJECT ,
            new \Evgeek\Moysklad\Http\GuzzleSender()
        );
//        $responece = $ms->endpoint('entity')
//            ->method('organization')
//            ->send('GET');
//
//        $organization = $responece->rows[0]->meta;



    }




}
