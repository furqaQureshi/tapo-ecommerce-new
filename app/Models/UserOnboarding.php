<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOnboarding extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'descriptions', 'preferences'];

    protected $casts = [
        'descriptions' => 'array',
        'preferences' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
