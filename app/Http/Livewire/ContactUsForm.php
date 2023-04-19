<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Mail;

class ContactUsForm extends Component
{
    public $name, $phoneContact,$privacy;

    public function submit(){

        $this->validate([
            'phoneContact' => ['required'],
            'privacy' => ['required',],

        ],[
            'privacy.required' => 'Подтвердите согласие'
        ]);

        $tel = preg_replace("/[^,.0-9]/", '', $this->phoneContact);

        if(strlen($tel) != 11){
           return  $this->addError('phoneContact', 'ввидете корректный номер телефона');
        }

        if( empty($this->name)){
            $this->name = 'Аноним';
        }

        \Illuminate\Support\Facades\Mail::to(config('mails.to'))->send(new \App\Mail\ContactMail([
            'name' => $this->name,
            'phone' => $this->phoneContact
        ]));
        $this->dispatchBrowserEvent('clearPhone', []);
        $this->name = null;
        session()->flash('message-contact','Благодарим за заказ'.$this->name.'! Мы начинаем работать с ним.');
    }


    public function render()
    {
        return view('livewire.contact-us-form');
    }
}
