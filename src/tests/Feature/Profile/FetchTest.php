<?php

namespace Tests\Feature\Profile;

use App\Models\Like;
use App\Models\Playlist;
use App\Models\Song;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

use function Psy\debug;

class FetchTest extends TestCase
{
  use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
    }
    /**
     * A basic feature test example.
     */
    #[Test]
    public function 成功(): void
    {
      $user = User::factory()->create();

    // プレイリストの作成
    $playlist = Playlist::factory()->create(['user_id' => $user->id]);
    echo "Playlist Created: " . $playlist->id . PHP_EOL;

    // プレイリストに紐づく曲の作成
    $songs = Song::factory()->count(3)->create(['playlist_id' => $playlist->id]);
    echo "Songs Created: " . $songs->pluck('id') . PHP_EOL;

    // Likesの作成
    $likes = Like::factory()->count(2)->create(['user_id' => $user->id, 'playlist_id' => $playlist->id]);
    echo "Likes Created: " . $likes->pluck('id') . PHP_EOL;

    // フォロワーの作成
    $followers = User::factory()->count(2)->create();
    foreach ($followers as $follower) {
        $follower->followees()->attach($user->id);
        echo "Follower Attached: " . $follower->id . PHP_EOL;
    }

    // 関連データの存在確認
    echo "Playlists Count: " . $user->playlists()->count() . PHP_EOL;
    echo "Likes Count: " . $user->likes()->count() . PHP_EOL;
    echo "Followers Count: " . $user->followers()->count() . PHP_EOL;

    // エンドポイントへのアクセス
    $response = $this->withoutMiddleware()
                     ->get('/api/profile/' . $user->id);

    // ステータスコード200を確認
    $response->assertStatus(200);

    // レスポンスの内容を出力して確認
    $response->dump();

    // // プレイリスト、曲、Likes、フォロワーが正しく取得できることを確認
    // $response->assertJsonStructure([
    //     'id',
    //     'username',
    //     'email',
    //     'playlists' => [
    //         '*' => [
    //             'id',
    //             'name',
    //             'songs' => [
    //                 '*' => [
    //                     'id',
    //                     'title',
    //                     'duration',
    //                 ],
    //             ],
    //         ],
    //     ],
    //     'likes' => [
    //         '*' => [
    //             'id',
    //             'playlist_id',
    //             'user_id',
    //         ],
    //     ],
    //     'followers' => [
    //         '*' => [
    //             'id',
    //             'username',
    //         ],
    //     ],
    // ]);
  }
}
