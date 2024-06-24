<?php

declare(strict_types=1);

namespace App\Data\Request\User;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
final class InitialData extends Data
{
    public function __construct(
        public readonly string $screenName,
        public readonly string $email,
        public readonly string $password,
    ) {
    }
}
