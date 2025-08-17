<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShortLinkTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
                         ->postJson('/api/short-links', [
                            'original_url' => 'https://www.google.com',
                         ]);
        
        $response->assertStatus(201);
        $this->assertDatabaseHas('short_links', [
            'original_url' => 'https://www.google.com',
            'user_id' => $user->id,
        ]);                  
    }
}
