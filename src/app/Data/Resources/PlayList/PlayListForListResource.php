<?php

namespace App\Data\Resources\PlayList;

use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

/** @typescript */
class PlayListForListResource extends Data
{
    public function __construct(
      public string $id,
      public string $name,
      public DateTime $created_at,
    ) {}
}
