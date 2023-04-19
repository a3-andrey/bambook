<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Support extends Component
{
    public $message;
    protected $rules = [
        'message' => 'required',
    ];

    public function hydrate(){
        if(Auth::user()->messages->where('is_show',0)->count() > 0){
            $this->dispatchBrowserEvent('endScrollChat', []);
        }
    }

    public function submit(){
        $this->validate();

        Auth::user()->messages()->create([
            'message'=>$this->message,
        ]);

        $this->message = null;

        $this->dispatchBrowserEvent('endScrollChat', []);
    }

    public function render()
    {
        return view('livewire.support',[
            'messages'=>Auth::user()->messages,
        ]);
    }
}
