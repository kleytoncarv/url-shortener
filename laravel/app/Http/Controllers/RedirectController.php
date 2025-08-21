<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirect($shortCode)
    {
        $link = ShortLink::where('short_code', $shortCode)->first();

        if (!$link) {
            return response('Link não encontrado', 404);
        }

        if ($link->expires_at && $link->expires_at->isPast()) {
            return response('Link expirado', 410);
        }

        return redirect($link->original_url);
    }
}
