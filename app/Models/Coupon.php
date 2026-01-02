<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'min_amount',
        'max_discount',
        'usage_limit',
        'used_count',
        'expiry_date',
        'status',
        'description',
        'per_user_limit'
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'value' => 'decimal:2',
        'min_amount' => 'decimal:2',
        'max_discount' => 'decimal:2',
    ];

    // Mutators
    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtoupper($value);
    }

    // Accessors
    public function getIsExpiredAttribute()
    {
        return $this->expiry_date < Carbon::now()->toDateString();
    }

    public function getUsagePercentageAttribute()
    {
        return $this->usage_limit > 0 ? round(($this->used_count / $this->usage_limit) * 100, 2) : 0;
    }

    public function getFormattedValueAttribute()
    {
        return $this->type === 'percentage' ? $this->value . '%' : '$' . number_format($this->value, 2);
    }

    public function getStatusBadgeAttribute()
    {
        if ($this->is_expired) {
            return '<span class="badge badge-danger">Expired</span>';
        }

        switch ($this->status) {
            case 'active':
                return '<span class="badge badge-success">Active</span>';
            case 'inactive':
                return '<span class="badge badge-secondary">Inactive</span>';
            default:
                return '<span class="badge badge-secondary">Unknown</span>';
        }
    }
    public function useCoupon()
    {
        if ($this->isValid()) {
            $this->increment('used_count');

            // If usage limit reached, mark as inactive
            if ($this->used_count >= $this->usage_limit) {
                $this->update(['status' => 'inactive']);
            }

            return true;
        }

        return false;
    }
    public function isValid()
    {
        return $this->status === 'active' &&
            !$this->isExpired() &&
            $this->used_count < $this->usage_limit;
    }
    public function isExpired()
    {
        return $this->expiry_date < Carbon::now() || $this->status === 'expired';
    }


    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeNotExpired($query)
    {
        return $query->where('expiry_date', '>=', Carbon::now()->toDateString());
    }

    public function scopeValid($query)
    {
        return $query->active()->notExpired();
    }

    // Methods
    public function canBeUsed()
    {
        return $this->status === 'active'
            && !$this->is_expired
            && $this->used_count < $this->usage_limit;
    }

    public function hasUserExceededUsageLimit($userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return false;
        }
        $used_coupon = UsedCoupon::where(['coupon_id' => $this->id, 'user_id' => $user->id])->first();
        if(!empty($used_coupon))
        {
            if($used_coupon->usage < $this->per_user_limit)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            return true;
        }
    }

    public function isApplicable($cartItems): bool
    {
        $productsIds = $this->products->isNotEmpty() ? $this->products->pluck('id')->toArray() : [];
        $categoriesIds = $this->categories->isNotEmpty() ? $this->categories->pluck('id')->toArray() : [];
        $variantIds = $this->variants->isNotEmpty() ? $this->variants->pluck('id')->toArray() : [];

        $cartItemProductIds = $cartItems->pluck('product_id')->unique()->toArray();
        $cartItemVariantIds = $cartItems->pluck('variant_id')->unique()->toArray();
        $cartItemCategories = Product::whereIn('id', $cartItemProductIds)->get()->pluck('category_id')->toArray();

        $result = false;

        if ($categoriesIds > 0) {
            $allInCategoryCoupon = empty(array_diff($cartItemCategories, $categoriesIds));
            if ($allInCategoryCoupon) {
                return true;
            }
        }

        if ($productsIds > 0) {
            $allInProductCoupon = empty(array_diff($cartItemProductIds, $productsIds));
            if ($allInProductCoupon) {
               $result = true;
            }
        }

        if ($variantIds > 0) {
            $allInVariantCoupon = empty(array_diff($cartItemVariantIds, $variantIds));
            if ($allInVariantCoupon) {
               $result = true;
            } else {
                $result = false;
            }
        }

        return $result;
    }

    public function incrementUsage()
    {
        $this->increment('used_count');
    }

    // public function calculateDiscount($amount)
    // {
    //     if (!$this->canBeUsed() || $amount < $this->min_amount) {
    //         return 0;
    //     }

    //     $discount = 0;

    //     if ($this->type === 'percentage') {
    //         $discount = ($amount * $this->value) / 100;
    //     } else {
    //         $discount = $this->value;
    //     }

    //     // Apply maximum discount limit if set
    //     if ($this->max_discount && $discount > $this->max_discount) {
    //         $discount = $this->max_discount;
    //     }

    //     return round($discount, 2);
    // }

    public function calculateDiscount($amount)
    {
        if (!$this->canBeUsed() || $amount < $this->min_amount) {
            return 0;
        }
        $discount = 0;
        if($this->type=='percentage')
        {
            $discount = ($amount * $this->value) / 100;
        }
        else
        {
            $discount = $this->value;
        }

            if($discount > $this->max_discount)
            {
                $discount =  $this->max_discount;
            }
        return round($discount, 2);
    }

    public function scopeAvailable($query)
    {
        return $query->active()
            ->whereRaw('used_count < usage_limit');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'coupon_categories');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'coupon_products');
    }

    public function variants()
    {
        return $this->belongsToMany(ProductVariant::class, 'coupon_product_variant', 'coupon_id', 'variant_id');
    }
}
