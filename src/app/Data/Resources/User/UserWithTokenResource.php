<?php

declare(strict_types=1);

namespace App\Data\Resources\User;

use Spatie\LaravelData\Data;

/** @typescript */
final class UserWithTokenResource extends Data
{
    public function __construct(
        public UserResource $user,
        public string $token,
    ) {
    }
}
