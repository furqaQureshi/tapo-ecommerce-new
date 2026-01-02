<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image', 'description', 'slug', 'status', 'unique_id'];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class)->where('is_subscription', 0);
    }
    
    public function getProductsCountAttribute()
    {
        return DB::table('products')->where('is_subscription',0)
            ->whereJsonContains('category_ids', (string) $this->id)
            ->count();
    }
}
