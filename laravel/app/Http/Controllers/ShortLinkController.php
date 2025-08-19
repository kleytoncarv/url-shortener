<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortLink;

class ShortLinkController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
            'user_id' => 'required|exists:users,id',
        ]);

        $shortLink = ShortLink::create([
            'original_url' => $request->original_url,
            'user_id' => $request->user_id,
            'short_code' => substr(md5(uniqid()), 0, 6), // gera um código curto aleatório
        ]);

        return response()->json($shortLink, 201);
    }
}
