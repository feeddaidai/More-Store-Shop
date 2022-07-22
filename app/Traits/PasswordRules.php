<?php


namespace App\Traits;
use App\Rules\Password;

trait PasswordRules
{
    protected function passwordRules()
    {
        return ['required', 'string', new Password];
    }
}
