<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'original_url' => 'required|url',
            'user_id' => 'required|exists:users,id',
        ]);

        $shortLink = ShortLink::create([
            'original_url' => $validated['original_url'],
            'user_id' => $validated['user_id'],
            'short_code' => Str::random(6),
            'expires_at' => now()->addDays(7), // expira em 7 dias
        ]);

        return response()->json($shortLink, 201);
    }
}
