<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable=['site_title', 'currency', 'short_des','description', 'favicon', 'photo','address','phone','email','logo'];
}
