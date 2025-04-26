<?php

namespace App\UseCases\Auth\Exceptions;

class LoginFailedException extends \Exception
{
    public function __construct()
    {
        parent::__construct('ログインに失敗しました', 401);
    }
}
