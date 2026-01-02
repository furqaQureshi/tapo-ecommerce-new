<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'type', 'description', 'price', 'discount', 'curlec_plan_id', 'status', 'have_offer', 'offer_expiry', 'offer_month'];
}
