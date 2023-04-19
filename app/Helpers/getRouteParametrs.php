<?php

function is_active_category($category){
    $params = false;

    if(request()->route()){
        $params = request()->route()->parameters;
    }

    if(is_array($params) && count($params)>0)
    {
        if($cat = \Illuminate\Support\Arr::get($params,'subcategory')){
            if($cat == $category){
                return 'active';
            }
        }

        if($cat = \Illuminate\Support\Arr::get($params,'category')){

            if(isset($cat->category) && $cat->category == $category){
                return 'active';
            }
        }

    }else{
        return '';
    }
}
