<?php

namespace Database\Factories;

use App\Models\ShortLink;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ShortLinkFactory extends Factory
{
    protected $model = ShortLink::class;

    public function definition(): array
    {
        return [
            'user_id'      => User::factory(), // sempre cria um usuário válido
            'short_code'   => Str::random(6),
            'original_url' => $this->faker->url(),
            'expires_at'   => now()->addDays(1), // por padrão, 1 dia de validade
        ];
    }
}
