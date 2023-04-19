<?php

namespace App\Http\Livewire;

use App\Facades\MoySklad_1_2_Facade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    public $user;
    use WithFileUploads;
    public $firstname,$lastname,$patronymic,$country,$address,$city,$phone,$email,$company,$delivery,$change=false;

    public function mount()
    {
        $this->user = Auth::user();

        $this->firstname = $this->user->firstname;
        $this->lastname = $this->user->lastname;
        $this->patronymic = $this->user->patronymic;

        $this->delivery = $this->user->delivery;

        $this->country = $this->delivery->country;
        $this->city = $this->delivery->city;
        $this->address = $this->delivery->address;
        $this->company = $this->user->company;

        $this->phone = $this->user->phone;
        $this->email = $this->user->email;
    }


    public function submit()
    {
        $rule = [
            'firstname' => 'required',
            'lastname' => 'required',

            'country' => 'required',
            'city' => 'required',
            'address' => 'required',

            'phone' => 'required',
            'email' => 'required',
        ];

        if(!empty($this->password) && $this->password!=$this->user->password){
            $rule['password'] = ['required','confirmed'];
        }

        $this->validate($rule);

        $counterparty = MoySklad_1_2_Facade::searchCounterparty(
            (new \Evgeek\Moysklad\Filter())
                ->eq('email', $this->email)
        );

        if($counterparty===false){
            abort(405,'Пользователь не найден');
        }

        $this->user->firstname = $this->firstname;
        $this->user->lastname = $this->lastname;
        $this->user->patronymic = $this->patronymic;
        $this->user->company = $this->company;

        $this->delivery->country = $this->country;
        $this->delivery->city = $this->city;
        $this->delivery->address = $this->address;

        $this->user->phone = $this->phone;
        $this->user->email = $this->email;

        if(!empty($this->password) && $this->password!=$this->user->password){
            $this->user->password = Hash::make($this->password);
        }

        $this->delivery->save();

        $this->user->save();

        MoySklad_1_2_Facade::updateConterpatry($counterparty->id,[
            'name' => $this->lastname.' '.mb_substr($this->firstname, 0,1).'.',
            'company' => $this->company,
            'legalFirstName' => $this->firstname,
            'legalLastName' => $this->lastname,
            'legalMiddleName' => $this->patronymic,
            'legalAddress' => $this->country.', '.$this->city.', '.$this->address,
            'phone' => $this->phone,
        ]);

        session()->flash('message','Изменения сохранены');

    }

    public function render()
    {
        return view('livewire.profile',['user'=>$this->user]);
    }
}
