<?php

namespace Tests\Feature;

use App\Models\ShortLink;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RedirectLinkTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function user_is_redirected_to_original_url_when_visiting_short_code()
    {
        $user = User::factory()->create();

        $shortLink = ShortLink::create([
            'original_url' => 'https://example.com',
            'short_code'   => 'abc123',
            'user_id'      => $user->id,
        ]);

        $response = $this->get('/s/' . $shortLink->short_code);

        $response->assertRedirect($shortLink->original_url);
    }
}
