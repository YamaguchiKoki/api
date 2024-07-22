<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SnsLink;
use App\Models\SnsProvider;
use App\Models\User;
use App\Models\UserSnsLink;

class UserSnsLinkFactory extends Factory
{
    protected $model = UserSnsLink::class;

    public function definition()
    {
      return [
        'user_id' => User::factory(),
        'provider_id' => SnsProvider::factory(),
        'url' => $this->faker->url,
    ];
    }
}
