<?php

namespace App\Data\Resources\PlayList;

use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

/** @typescript */
class PlayListResource extends Data
{
    public function __construct(
      public string $id,
      public string $name,
      public string $description,
      public string|Optional $image_url,
      public int|Optional $added_to_bookshelf_count,
      /** @var \App\Data\Resources\Song\SongResource[] */
      public readonly array $songs,
      public DateTime $created_at,
    ) {}
}
