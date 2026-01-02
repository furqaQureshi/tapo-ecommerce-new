<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAPIService extends Model
{
    use HasFactory;

    protected $table = 'product_api_services'; 

    protected $fillable = ['product_id','api_service_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function apiservice()
    {
        return $this->belongsTo(APIService::class , 'api_service_id');
    }
}
