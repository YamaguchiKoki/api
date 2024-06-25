<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Playlist;
use App\Models\Song;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // Playlist::factory(10)->recycle($user)->create();
        Playlist::factory(10)->create(['user_id' => $user->id])->each(function ($playlist) {
          Song::factory(5)->create(['playlist_id' => $playlist->id]);
        });

        $playlists = Playlist::factory(10)->create();

        // $userがこれらのPlaylistをlikeする
        $user->likedPlaylists()->attach($playlists->pluck('id'));
        $follower = User::factory()->create([
          'screen_name' => 'Test follower',
          'email' => 'follower@example.com',
          'password' => bcrypt('password123'),
        ]);

        $followee = User::factory()->create([
            'screen_name' => 'Test followee',
            'email' => 'followee@example.com',
            'password' => bcrypt('password123'),
        ]);

        // フォロー関係を設定
        $user->followers()->attach($follower->id);
        $user->followees()->attach($followee->id);

        // 追加で10人のフォロワーを作成して$userに関連付け
        $followers = User::factory(10)->create();
        foreach ($followers as $follower) {
            $user->followers()->attach($follower->id);
        }

        // 追加で10人のフォロイーを作成して$userに関連付け
        $followees = User::factory(10)->create();
        foreach ($followees as $followee) {
            $user->followees()->attach($followee->id);
        }
        $snsProviders = SnsProvider::all();

        // 各SNSプロバイダーに対してuserを関連付け
        foreach ($snsProviders as $snsProvider) {
            $user->snsProviders()->attach($snsProvider->id, ['sns_user_id' => 'example_sns_user_id_' . $snsProvider->id]);
        }
    }
}
