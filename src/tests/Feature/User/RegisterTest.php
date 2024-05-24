<?php

declare(strict_types=1);

namespace Tests\Feature\User;

use App\Mail\AuthCodeMailable;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class RegisterTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
    }

    #[Test]
    public function ユーザー初回登録時メール送信テスト(): void
    {
        //準備
        Mail::fake();
        $attributes = ['email' => 'test@example.com', 'password' => 'password'];

        $expected = [
            'message' => '登録されたメールアドレス宛に認証コードを送信しました',
        ];

        //実行
        $response = $this->postJson('api/user/create', $attributes);

        //検証
        $response->assertStatus(201);
        $response->assertJson($expected);

        Mail::assertSent(AuthCodeMailable::class, 1);
        Mail::assertSent(fn (Mailable $mailable) => $mailable->hasTo('test@example.com'));

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'status' => 0,
        ]);
    }

    #[Test]
    public function 仮登録済みユーザーの場合認証コード再送テスト()
    {
        Mail::fake();
        $user = User::factory()->create();

        $expected = [
            'message' => '登録されたメールアドレス宛に認証コードを送信しました',
        ];

        $attributes = ['email' => $user->email, 'password' => 'password'];

        $response = $this->postJson('/api/user/create', $attributes);

        $response->assertStatus(201);
        $response->assertJson($expected);

        Mail::assertSent(AuthCodeMailable::class, 1);
        Mail::assertSent(fn (Mailable $mailable) => $mailable->hasTo($user->email));

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
            'status' => 0,
        ]);
    }

    #[Test]
    public function 本登録済みメールアドレスは否認()
    {
        $user = User::factory()->create(['status' => 1]);

        $expected = [
            'error' => '登録済みユーザーのため登録できません。',
        ];

        $attributes = ['email' => $user->email, 'password' => $user->password];

        $response = $this->postJson('/api/user/create', $attributes);

        $response->assertStatus(409);
        $response->assertJson($expected);
    }
}
