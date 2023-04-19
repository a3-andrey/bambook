<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class Order extends Component
{
    use WithFileUploads;

    public $name,$email,$comment,$file;

    public function submit(){
        $this->validate([
            'file' => 'required|max:10024', // 1MB Max
            'name' => 'required', // 1MB Max
            'email' => 'required', // 1MB Max
            'comment' => 'required', // 1MB Max
        ]);
    }

    public function render()
    {
        return view('livewire.order');
    }
}
