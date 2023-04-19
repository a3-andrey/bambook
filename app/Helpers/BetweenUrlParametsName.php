<?php

function betweenUrlParameterName($str){

    $betweenParam = \Illuminate\Support\Str::between($str, '{', '}');

    if(\Illuminate\Support\Str::contains($betweenParam,':')){
        $params = explode(':',$betweenParam);
        $param = \Illuminate\Support\Arr::get($params,0);
        $name = \Illuminate\Support\Arr::get($params,1);

        $model = \Illuminate\Support\Facades\Route::current()->parameter($param);

        if($model instanceof Illuminate\Database\Eloquent\Model){
            if($string = $model->$name){
                return str_replace('{'.$betweenParam.'}',$string,$str);
            }else{
                config('site.title','Example title');
            }

        }
    }
    return $betweenParam;

}
