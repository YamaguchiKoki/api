<?php

declare(strict_types=1);

namespace App\Data\Resources\User;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;

/** @typescript */
final class UserResource extends Data
{
    #[MapOutputName(SnakeCaseMapper::class)]
    #[MapInputName(SnakeCaseMapper::class)]
    public function __construct(
        public string $id,
        public string|Optional $screenName,
        public string|Optional $bio,
        public string|Optional $imageUrl,
    ) {
    }
}
