<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Search extends Component
{
    public $search,$result,$items=[];

    public function updatedSearch($value)
    {
        //
        if(empty($this->search)){
            $this->result = false;
        }else{
            $this->result = true;
            $this->items = Product::where('name','LIKE',"%{$this->search}%")->active()->get();

//            $words = explode(' ', $this->search);
//            $results = collect();
//            foreach ($words as $word){
//                $results[] = Product::where('name','LIKE',"%{$word}%")->active()->get();
//            }
//
//            if($results->count() > 0){
//                $results->reverse();
//            }
//             $this->items = $results->collapse();

        }
    }

    public function searchResualt(){

    }

    public function render()
    {
        return view('livewire.search');
    }
}
