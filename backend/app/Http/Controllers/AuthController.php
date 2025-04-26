<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\UseCases\Auth\LoginAction;
use App\UseCases\Auth\LogoutAction;

class AuthController extends Controller
{
    public function login(LoginRequest $request, LoginAction $action): void
    {
        $action($request->email, $request->password);
    }

    public function logout(LogoutAction $action): void
    {
        $action();
    }
}
