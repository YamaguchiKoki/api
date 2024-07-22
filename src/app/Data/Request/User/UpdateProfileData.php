<?php

declare(strict_types=1);

namespace App\Data\Request\User;

use Spatie\LaravelData\Data;

class UpdateProfileData extends Data
{
    public function __construct(
        public string $screen_name,
        public ?string $bio,
        public ?string $spotify,
        public ?string $youtube,
        public ?string $soundcloud,
        public ?string $applemusic,
        public ?string $linemusic,
        public ?string $bandcamp,
        public ?string $twitter,
    ) {
    }

    // public static function rules(): array
    // {
    //     return [
    //         'screen_name' => ['required', 'string', 'max:255'],
    //         'bio' => ['nullable', 'string', 'max:1000'],
    //         'spotify' => ['nullable', 'url', 'max:255'],
    //         'youtube' => ['nullable', 'url', 'max:255'],
    //         'soundcloud' => ['nullable', 'url', 'max:255'],
    //         'applemusic' => ['nullable', 'url', 'max:255'],
    //         'linemusic' => ['nullable', 'url', 'max:255'],
    //         'bandcamp' => ['nullable', 'url', 'max:255'],
    //         'twitter' => ['nullable', 'url', 'max:255'],
    //     ];
    // }
}
