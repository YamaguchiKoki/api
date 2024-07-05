<?php
namespace Database\Factories;

use App\Enums\SongUrlType;
use App\Models\Song;
use App\Models\Playlist;
use Illuminate\Database\Eloquent\Factories\Factory;

class SongFactory extends Factory
{
    protected $model = Song::class;

    public function definition()
    {
        return [
          'playlist_id' => Playlist::factory(),
          'name' => $this->faker->sentence,
          'order' => $this->faker->numberBetween(1, 10),
          'url' => $this->faker->url,
          'url_type' => $this->faker->randomElement(array_column(SongUrlType::cases(), 'value')),
        ];
    }
}
