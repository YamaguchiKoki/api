<?php

declare(strict_types=1);

namespace App\Data\Resources\Sns;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

class SnsProviderData extends Data
{
    #[MapOutputName(SnakeCaseMapper::class)]
    #[MapInputName(SnakeCaseMapper::class)]
    public function __construct(
        public int $id,
        public string $providerName,
    ) {
    }
}
