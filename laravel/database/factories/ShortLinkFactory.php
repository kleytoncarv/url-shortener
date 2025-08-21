<?php

namespace Database\Factories;

use App\Models\ShortLink;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ShortLinkFactory extends Factory
{
    protected $model = ShortLink::class;

    public function definition()
    {
        return [
            'short_code' => Str::random(6),
            'original_url' => $this->faker->url(),
            'expires_at' => null, // por padrão sem expiração
        ];
    }
}
