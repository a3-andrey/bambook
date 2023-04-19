<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TelRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        $strReplace = tel($value);
        $numbers =  preg_replace("/[^0-9]/", '', $strReplace);
        return strlen($numbers) === 11;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Номер телефона введен неверно';
    }
}
