<?php

namespace App\UseCases\User\Exceptions;

use Exception;

class DuplicateUserException extends Exception
{
  protected $message = '登録済みユーザーのため登録できません。';
  protected $code = 409; //Conflict

  public function __construct()
  {
      parent::__construct($this->message, $this->code);
  }
}
