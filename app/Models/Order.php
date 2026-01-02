<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'type',
        'user_id',
        'guest_email',
        'guest_phone',
        'transaction_id',
        'status',
        'on_hold',
        'total_amount',
        'currency',
        'payment_method',
        'payment_id',
        'is_paid',
        'wallet_amount_used',
        'coupon_code',
        'discount_amount',
        'notes',
        'unique_id',
        'delivery_status',
        'refund_status',
        'source',
        'fields',
        'coupon_id',
        'discount_applied',
        'grand_total',
        'subscription_total',
        'shipping_id',
        'shipping_cost',
        'bundle_plan_name',
        'bundle_plan_price',
        'plan_id',
        'points_discount',
        'total_addon_price',
        'subscription_frequency',
        'subscription_start_at',
        'subscription_expire_at',
        'subscription_link',
        'razorpay_order_id',
        'razorpay_subscription_id',
        'razorpay_customer_id',
        'merchant_order_id',
        'subscription_status',
        'paid_count',
        'remaining_count',
        'next_charge_at',
        'tracking_no',
        'child_tracking_no',
        'tracking_url',
        'consignment_jpeg',
        'consignment_pdf',
        'consignment_zpl',
        'routing_code',
        'estimated_cost',
        'total_weight',
        'state_id',
        'city_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'address',
        'state_id',
        'city_id',
        'postal_code',
    ];

    protected $casts = [
        'fields' => 'array', // Cast fields to array for easier JSON handling
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }

    public function history()
    {
        return $this->hasMany(OrderHistory::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function redeemed()
    {
        return $this->belongsTo(ProductOrderPointLog::class, 'id', 'order_id')->where('status', 'redeemed');
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }

    public function refundRequest()
    {
        return $this->hasOne(RefundRequest::class, 'order_id');
    }

    public function order_detail()
    {
        return $this->belongsTo(OrderDetail::class, 'id', 'order_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id', 'id');
    }

    public function isFormFilled()
    {
        return !empty($this->fields);
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

}
