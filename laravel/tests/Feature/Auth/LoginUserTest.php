<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginUserTest extends TestCase
{
    use RefreshDatabase;

    /**@test */
    public function user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'email' => 'kleyton@eample.com',
            'password' => Hash::make('password123')
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'email' => 'kleyton@example.com'
            ]);
    }
    /** @test */
    public function user_cannot_login_with_wrong_password()
    {
        $user = User::factory()->create([
            'email' => 'kleyton@example.com',
            'password' => Hash::make('password123')
        ]);

        $response = $this->postJson('/auth/login', [
            'email' => 'kleyton@example.com',
            'password' => 'wrongpassword'
        ]);
    }
}

    
