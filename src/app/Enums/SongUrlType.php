<?php

declare(strict_types=1);

namespace App\Enums;

enum SongUrlType: string
{
  case YouTube = 'YouTube';
  case Spotify = 'Spotify';
  case AppleMusic = 'AppleMusic';
  case LineMusic = 'LineMusic';
  case SoundCloud = 'SoundCloud';
  case BandCamp = 'BandCamp';
}
