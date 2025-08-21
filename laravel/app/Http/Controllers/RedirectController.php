<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;

class RedirectController extends Controller
{
    public function redirect($shortCode)
    {

        $link = ShortLink::where('short_code', $shortCode)->first();

        if (!$link) {
            return response()->view('errors.link-not-found', [],404);
        }

        if ($link->expire_at && $link->expires_at->isPast()){
            return response()->view('errors.link-expired', [], 410);
        }
        
        return redirect($link->original_url);
    }
}
