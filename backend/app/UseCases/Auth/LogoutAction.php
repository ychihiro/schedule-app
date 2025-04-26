<?php

namespace App\UseCases\Auth;

use Illuminate\Support\Facades\Auth;

class LogoutAction
{
    public function __invoke(): void
    {
        Auth::logout();
    }
}
