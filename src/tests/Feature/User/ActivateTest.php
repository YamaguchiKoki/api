<?php

declare(strict_types=1);

// namespace Tests\Feature\User;

// use App\Models\Otp;
// use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use PHPUnit\Framework\Attributes\Test;
// use Tests\TestCase;

// final class ActivateTest extends TestCase
// {
//     use RefreshDatabase, WithFaker;

//     protected function setUp(): void
//     {
//         parent::setUp();
//     }

// #[Test]
// public function 認証コード検証テスト(): void
// {
//     //準備
//     $user = User::factory()->create();
//     $otp = Otp::factory()->create(['user_id' => $user->id]);
//     $postData = ['otp' => $otp->otp_code];

//     $response = $this->postJson('/api/user/activate', $postData);

//     $response->assertStatus(200);
// }
// }
