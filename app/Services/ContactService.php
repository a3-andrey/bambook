<?php


namespace App\Services;
use App\Models\Contact as ModelContact;

class ContactService
{
    public function get($slug = null){
        if($slug){
            return ModelContact::where('slug',$slug)->first();
        }
        return ModelContact::all();
    }

}
