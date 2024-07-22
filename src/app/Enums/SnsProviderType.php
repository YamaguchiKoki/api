<?php
namespace App\Enums;

enum SnsProviderType: string
{
    case SPOTIFY = 'Spotify';
    case YOUTUBE = 'YouTube';
    case SOUNDCLOUD = 'SoundCloud';
    case APPLEMUSIC = 'AppleMusic';
    case LINEMUSIC = 'LineMusic';
    case BANDCAMP = 'BandCamp';
    case TWITTER = 'Twitter';
}
