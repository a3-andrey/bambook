<?php

namespace App\Services;
use App\Models\Text;
use Illuminate\Support\Facades\Auth;

class TextService
{
    public $text;

   public function get($slug){
        $block = Text::where('slug',$slug)->first();

        if($block){
            $this->text = textarea_br($block->textarea);

            if(Auth::guard('admin')->check()){
                $view = view('admin.blade.text-helper',[
                    'text'=>$this->text,
                    'block'=>$block,
                ]);
                $this->text = $view->render();

            }
        }else{
            $this->text = null;
        }

        return $this->text;
   }
}
