<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AuthRule implements Rule
{
    private $password;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(String $password="")
    {
        $this->$password = $password;
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
        $credentional = [$value,$this->password];

        if(Auth::attempt($credentional)){
            Auth::guard('admin')->login();
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Похоже, что вы не админ';
    }
}


/**
 * admin
 * email: admin@admin.com12
 * password: adminadminadmin
 * username: adminadmin
 */