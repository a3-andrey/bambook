<?php

namespace App\Traits;

use App\Rules\TelRule;

trait OrderFormRequestTrait
{
    public function validateLegal(){
        $this->validate([
            'inn' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string',  new TelRule()],
            'email' => ['required', 'string', 'max:255','email', 'max:255', ],
            'city' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'confirmation' => ['required'],
        ]);
    }

    public function validateIndividual(){
        $this->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', new TelRule()],
            'email' => ['required', 'string', 'max:255','email'],
            'city' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'confirmation' => ['required','accepted'],
        ]);
    }

    public function validatePickupLegal(){
        $this->validate([
            'inn' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', new TelRule()],
            'email' => ['required', 'string', 'max:255','email'],
            'confirmation' => ['required'],
        ]);
    }

    public function validatePickupIndividual(){
        $this->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', new TelRule()],
            'email' => ['required', 'string', 'max:255','email'],
            'confirmation' => ['required'],
        ]);
    }

}
