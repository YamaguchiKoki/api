<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\SongUrlType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Song extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
      'url_types' => SongUrlType::class,
    ];

    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }
}
