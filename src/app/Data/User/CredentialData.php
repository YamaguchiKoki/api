<?php

declare(strict_types=1);

namespace App\Data\User;

use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Data;

final class CredentialData extends Data
{
    public function __construct(
        public string $email,
        public string $password,
    ) {
        $this->password = Hash::make($password);
    }
}
