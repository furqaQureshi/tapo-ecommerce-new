<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'attribute_id', 'attribute_value', 'price', 'discount', 'qty'];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
