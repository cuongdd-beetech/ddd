<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;


class AgeRule implements Rule
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
        $age =  \Carbon\Carbon::parse($value)->age;

        if($age >= 18) {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be greater than 18.';
    }
}
