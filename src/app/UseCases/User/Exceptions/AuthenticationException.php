<?php

declare(strict_types=1);

namespace App\UseCases\User\Exceptions;

use Exception;

final class AuthenticationException extends Exception
{
    protected $message = '認証情報が誤っています';

    protected $code = 401; //

    public function __construct()
    {
        parent::__construct($this->message, $this->code);
    }
}
