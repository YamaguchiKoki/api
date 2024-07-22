<?php
namespace Database\Factories;

use App\Models\SnsProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class SnsProviderFactory extends Factory
{
    protected $model = SnsProvider::class;

    public function definition()
    {
        return [
            'provider_name' => $this->faker->unique()->randomElement(['YouTube', 'Spotify', 'SoundCloud', 'AppleMusic', 'LineMusic', 'BandCamp', 'Twitter']),
        ];
    }
}
