<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function user_can_register_with_valid_data()
    {
        $response = $this->postJson('/api/register', [   // corrigido para /api/register
            'name' => 'Kleyton',
            'email' => 'kleyton@example.com',
            'password' => 'password123'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'email' => 'kleyton@example.com'
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function user_cannot_register_with_existing_email()
    {
        User::factory()->create([
            'email' => 'kleyton@example.com'
        ]);

        $response = $this->postJson('/api/register', [   // corrigido para /api/register
            'name' => 'Outro',
            'email' => 'kleyton@example.com',
            'password' => 'password123'
        ]);

        $response->assertStatus(422);
    }
}
