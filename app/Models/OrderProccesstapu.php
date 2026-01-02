<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProccesstapu extends Model
{
    use HasFactory;

        protected $fillable = [
        'order_id',
        'first_name',
        'last_name',
        'email',
        'state',
        'city',
        'zipcode',
        'month',
        'year',
        'card_number',
        'security_code',
        'payment_method',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
