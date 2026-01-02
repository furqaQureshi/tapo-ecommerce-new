<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $casts = [
        'category_ids' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    public function getCategoriesAttribute()
    {
        return Category::whereIn('id', $this->category_ids ?? [])->get();
    }


    public function media()
    {
        return $this->hasMany(ProductMedia::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class)->orderBy('order', 'asc');
    }
    
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function fields()
    {
        return $this->hasMany(ProductField::class)->orderBy('id', 'asc');
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function apiServices()
    {
        return $this->belongsToMany(APIService::class, 'product_api_services', 'product_id', 'api_service_id');
    }
    public function affiliates()
    {
        return $this->hasMany(ProductAffiliate::class, 'product_id', 'id');
    }

    public function addOnProducts()
    {
        return $this->hasMany(AddOnProduct::class);
    }
}
