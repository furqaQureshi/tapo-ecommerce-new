<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'sku',
        'variant_qty',
        'region',
        'denomination',
        'price',
        'order'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getPriceAttribute($value)
    {
        $margin = Setting::first()->product_margin ?? config('app.product_margin');

        if ($this->source === 'M') {
            $markup = 1 + ($margin / 100);
            return round($value * $markup, 2);
        }

        return $value;
    }
}
