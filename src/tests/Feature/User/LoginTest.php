<?php

declare(strict_types=1);

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

final class LoginTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->create([
            'email' => 'test@test.com',
            'password' => 'password',
        ]);
        $postData = [
            'email' => 'test@test.com',
            'password' => 'password',
        ];

        $response = $this->postJson('/api/login', $postData);
        // dump($response->all());

        $response->assertStatus(201);
    }
}
