<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryInterval extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'weeks',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'weeks' => 'integer',
    ];
}
