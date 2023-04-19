<?php

function image($image)
{
    if(empty($image)){
        return config('app.no_image');
    }
    return \Illuminate\Support\Facades\Storage::url($image);
}
