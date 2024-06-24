<?php

declare(strict_types=1);

namespace App\Data\Request\Song;

use App\Enums\SongUrlType;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
final class SongData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $url,
        public readonly SongUrlType $type,
    ) {
    }
}
