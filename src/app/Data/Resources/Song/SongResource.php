<?php

declare(strict_types=1);

namespace App\Data\Resources\Song;

use App\Enums\SongUrlType;
use DateTime;
use Spatie\LaravelData\Data;

final class SongResource extends Data
{
    public function __construct(
        public readonly string $id,
        public readonly int $order,
        public readonly string $name,
        public readonly string $url,
        public readonly SongUrlType $url_type,
        public DateTime $created_at,
    ) {
    }

    // public static function collection()
}
