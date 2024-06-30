<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Playlist;
use App\Models\SnsProvider;
use App\Models\Song;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserSnsLink;
use Illuminate\Database\Seeder;
use App\Models\SnsProvider;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SnsProvidersTableSeeder::class);

        $user = User::factory()->create([
            'screen_name' => 'Test User',
            'email' => 'email@example.com',
            'password' => 'password123',
        ]);
        $playlists = Playlist::factory(30)->recycle($user)->create();

        foreach ($playlists as $playlist) {
          Song::factory()->count(3)->create(['playlist_id' => $playlist->id]);
          Like::factory()->count(2)->create(['user_id' => $user->id, 'playlist_id' => $playlist->id]);
        }

        $followers = User::factory()->count(2)->create();
        foreach ($followers as $follower) {
            $follower->followees()->attach($user->id);
        }
        // SnsProviderのデータを作成
        $snsProviders = ['YouTube', 'Spotify', 'SoundCloud', 'AppleMusic', 'LineMusic', 'BandCamp', 'Twitter'];
        foreach ($snsProviders as $providerName) {
            SnsProvider::factory()->create(['provider_name' => $providerName]);
        }

        // UserSnsLinkのデータを作成
        foreach ($snsProviders as $providerName) {
            $provider = SnsProvider::where('provider_name', $providerName)->first();
            UserSnsLink::factory()->create([
                'user_id' => $user->id,
                'provider_id' => $provider->id,
            ]);
        }
    }
}
