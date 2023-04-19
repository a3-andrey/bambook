<?php

namespace App\Http\Livewire;



use App\Contracts\PayContract;
use App\Models\Order;
use Livewire\Component;

class Quiz extends Component
{
    public $answers = [];

    public $email,$name;



    public function mount(){

    }

    public function updatedEmail($val){
        if(!empty($this->name) && !empty($this->email)){
            $this->dispatchBrowserEvent('send_good', []);
        }else{
            $this->dispatchBrowserEvent('send_not_good', []);
        }
    }

    public function updatedName($val){
        if(!empty($this->name) && !empty($this->email)){
            $this->dispatchBrowserEvent('send_good', []);
        }else{
            $this->dispatchBrowserEvent('send_not_good', []);
        }
    }

    public function send(PayContract $contract){
       $url =  $contract->pay(Order::create([
            'total' => 299,
            'order' => [
                'quiz' => $this->answers,
                'user' => [
                    'name' => $this->name,
                    'email' => $this->email,
                ]
            ],
        ]));

    }

    public function render()
    {
        return view('livewire.quiz');
    }
}
