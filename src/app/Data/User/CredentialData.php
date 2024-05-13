<?php

declare(strict_types=1);

namespace App\Data\User;

use DateTime;
use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class CredentialData extends Data
{


  public function __construct(
    public string $email,
    public string $password,
    public int | Optional $otp,
    public DateTime | Optional $expiredAt,
  ) {
    $this->password = Hash::make($password);
  }
}
