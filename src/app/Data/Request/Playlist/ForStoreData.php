<?php

declare(strict_types=1);

namespace App\Data\Request\Playlist;

use App\Data\Request\Song\SongData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;

#[MapInputName(SnakeCaseMapper::class)]
final class ForStoreData extends Data
{
    public function __construct(
        public readonly string $userId,
        public readonly ?string $imageUrl,
        public readonly string $title,
        public readonly string $description,
        /** @var \App\Data\Request\Song\SongData[] */
        public readonly array $songs,
    ) {
    }
}
