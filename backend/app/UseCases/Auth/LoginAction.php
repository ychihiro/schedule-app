<?php

namespace App\UseCases\Auth;

use App\UseCases\Auth\Exceptions\LoginFailedException;
use Illuminate\Support\Facades\Auth;

class LoginAction
{
    public function __invoke(string $email, string $password): void
    {
        $credentials = compact('email', 'password');

        if (! Auth::attempt($credentials)) {
            throw new LoginFailedException;
        }
    }
}
