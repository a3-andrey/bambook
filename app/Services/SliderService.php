<?php
namespace App\Services;

class SliderService
{

    public function get($id)
    {

        $slider =  \App\Models\Slider::find($id);
        if($slider){
           return  $slider->sliders;
        }
        return [];
    }

}
