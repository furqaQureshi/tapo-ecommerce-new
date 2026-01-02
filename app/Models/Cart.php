<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
   use HasFactory;
   protected $fillable = ['user_id', 'variant_id', 'source', 'product_id', 'attributes', 'quantity', 'price', 'discount', 'addon_price', 'fields', 'game_user_id', 'game_server_id', 'game_user_name', 'game_email'];

   protected $casts = [
      'attributes' => 'array',
   ];
   
   public function product()
   {
      return $this->belongsTo(Product::class, 'product_id', 'id');
   }

   public function product_variant()
   {
      return $this->belongsTo(ProductVariant::class, 'variant_id', 'id');
   }

   public function user()
   {
      return $this->belongsTo(User::class, 'user_id', 'id');
   }
}
