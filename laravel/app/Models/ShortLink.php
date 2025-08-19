<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShortLink extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'original_url', 'short_code'];
}
