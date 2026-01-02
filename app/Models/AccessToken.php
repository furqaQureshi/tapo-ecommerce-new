<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    protected $fillable = [
        'access_token',
        'token_type',
        'expires_in',
    ];
}
