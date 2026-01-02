<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyProduct extends Model
{
    use HasFactory;

    protected $fillable = ['month_of', 'product_ids'];

    protected $casts = [
        'product_ids' => 'array',
    ];

    public function getProductNamesAttribute()
    {
        return Product::whereIn('id', $this->product_ids ?? [])->pluck('name')->toArray();
    }

    public function getProducts()
    {
        return Product::whereIn('id', $this->product_ids)->get();
    }
}
