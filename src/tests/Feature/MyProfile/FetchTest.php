<?php

namespace Tests\Feature\MyProfile;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

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

      // テスト用のユーザーを作成
      $user = User::factory()->create();

      // ユーザーにJWTトークンを生成
      $token = Auth::guard('jwt')->login($user);

      // JWTトークンを使用してリクエストを送信
      $response = $this->withHeaders([
          'Authorization' => 'Bearer ' . $token,
      ])->get('/api/profile');

      // レスポンスの検証
      $response->assertStatus(200)
               ->assertJson([
                   'success' => true,
      ]);
    }
}
