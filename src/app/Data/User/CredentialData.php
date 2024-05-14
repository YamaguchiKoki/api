<?php

declare(strict_types=1);

namespace App\Data\User;

use DateTimeImmutable;
use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

final class CredentialData extends Data
{
    public function __construct(
        public string $email,
        public string $password,
        public int|Optional $otp,
        public DateTimeImmutable|Optional $expiredAt,
    ) {
        $this->password = Hash::make($password);
    }
}
