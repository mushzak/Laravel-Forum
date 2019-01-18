<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EndWithDot implements Rule
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
       return (is_null($value) || $value[strlen($value)-1] == '.') ? true : false ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Must end with dot (.)';
    }
}
