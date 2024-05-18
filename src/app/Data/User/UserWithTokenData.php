<?php

declare(strict_types=1);

namespace App\Data\User;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;

#[MapInputName(SnakeCaseMapper::class)]
final class UserWithTokenData extends Data
{
    public function __construct(
        public string $id,
        public string $token,
        public string|Optional $screenName,
        public string|Optional $bio,
        public string|Optional $imageUrl,
    ) {
    }
}
