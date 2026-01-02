<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class APIService extends Model
{
    use HasFactory;

    protected $table = 'api_services';
    protected $fillable = ['name','slug','base_url','auth_type','headers','credentials','notes','is_active'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_api_services', 'api_service_id', 'product_id');
    }
}
