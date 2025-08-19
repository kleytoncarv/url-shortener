<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShortLinkTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_short_link()
    {
        // cria um usuário fake
        $user = User::factory()->create();

        // faz o POST para a rota real
        $response = $this->postJson('/api/short-links', [
            'original_url' => 'https://example.com',
            'user_id' => $user->id,
        ]);

        // espera que a resposta seja 201
        $response->assertStatus(201);

        // espera que tenha salvo no banco
        $this->assertDatabaseHas('short_links', [
            'original_url' => 'https://example.com',
            'user_id' => $user->id,
        ]);
    }
}
