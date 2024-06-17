<?php

namespace Tests\Feature\Playlist;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class StoreTest extends TestCase
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

        $postData = [
          'userId' => $user->id,
          'title' => 'test title',
          'description' => 'nullable|string',
          'songs' => [
              [
                  'name' => 'song1',
                  'url' => 'http://localhost:3000/notes',
                  'type' => 'YouTube',
              ],
              [
                  'name' => 'song2',
                  'url' => 'http://localhost:3000/notes',
                  'type' => 'YouTube',
              ],
              [
                  'name' => 'song3',
                  'url' => 'http://localhost:3000/notes',
                  'type' => 'YouTube',
              ],
          ],
      ];
      $response = $this->actingAs($user, 'jwt')
                       ->postJson('/api/playlist/store', $postData);

        $response->assertStatus(201);
    }
}
