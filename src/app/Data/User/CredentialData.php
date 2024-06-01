<?php

declare(strict_types=1);

namespace App\Data\User;

use Spatie\LaravelData\Data;

final class CredentialData extends Data
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    ) {
    }
}
