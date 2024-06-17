<?php

namespace Tests\Feature\Playlist;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FetchAllTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->create();

        $playlists = Playlist::factory(10)->create([
          'user_id' => $user->id
        ]);
        // dump($user, $playlists);

        $response = $this->withoutMiddleware()->get(route('playlist.index',[
          'author_id' => $user->id
        ] ));

        $response->assertStatus(200);
    }
}
