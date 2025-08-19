<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;

class RedirectController extends Controller
{
    public function redirect($shortCode){
        $link = ShortLink::where('short_code', $shortCode)->firstOrFail();
        return redirect($link->original_url);
    }
}
