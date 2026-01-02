<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponProductVariant extends Model
{
    use HasFactory;

    protected $table = 'coupon_product_variant';

    protected $fillable = ['variant_id', 'coupon_id'];

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
