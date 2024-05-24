<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
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
      $response = $this->get('/');

      $response->assertStatus(200);
  }
}
