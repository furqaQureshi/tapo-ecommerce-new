<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddOnProduct extends Model
{
    use HasFactory;

    protected $fillable = ['add_on_product_id','product_id'];

    public function adOnProduct()
    {
        return $this->belongsTo(Product::class,'add_on_product_id');
    }
}
