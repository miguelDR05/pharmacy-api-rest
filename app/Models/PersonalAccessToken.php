<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumToken;
use App\Traits\SanitizesTimestamps;

class PersonalAccessToken extends SanctumToken
{
    use SanitizesTimestamps;

    protected $fillable = [
        'tokenable_type',
        'tokenable_id',
        'name',
        'token',
        'abilities',
        'last_used_at',
        'expires_at',
        'created_at',
        'updated_at'
    ];
}
