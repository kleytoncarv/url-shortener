<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShortLinkTest extends TestCase
{
    use RefreshDatabase; // garante que o banco será resetado a cada teste

    public function test_user_can_create_short_link()
    {
        $user = User::factory()->create();

        // Vamos simular a criação de um link curto
        $response = $this->post('/short-links', [
            'original_url' => 'https://example.com',
            'user_id' => $user->id,
        ]);

        // Esperamos que o link curto exista no banco
        $this->assertDatabaseHas('short_links', [
            'original_url' => 'https://example.com',
            'user_id' => $user->id,
        ]);
    }
}
