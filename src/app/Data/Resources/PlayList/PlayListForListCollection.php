<?php

namespace App\Data\Resources\PlayList;

use Illuminate\Database\Eloquent\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/** @typescript */
class PlayListForListCollection extends Data
{
    public int $amount;
    public function __construct(
      #[DataCollectionOf(PlayListForListResource::class)]
      public DataCollection $playlists,
    )
    {
      $this->amount = count($playlists);
    }
}
