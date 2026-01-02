<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;

// class User extends Authenticatable implements MustVerifyEmail
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'completed_profile',
        'phone',
        'password',
        'role_id',
        'avatar',
        'is_suspended',
        'email_verified_at',
        'google_id',
        'wallet_balance',
        'weekly_limit',
        'reward_points',
        'redeemed_points',
        'first_name',
        'city',
        'postal_code',
        'role_id',
        'address',
        'state',
        'points'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the role that owns the user.
     */
    // public function role()
    // {
    //     return $this->belongsTo(Role::class);
    // }

    public function cartItems()
    {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }
    public function onboarding()
    {
        return $this->hasOne(UserOnboarding::class);
    }
    /**
     * Check if the user has the admin role
     */
    public function isAdmin()
    {
        return $this->role_id === 1;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function subscription_detail()
    {
        return $this->hasOne(UserSubscriptionDetail::class);
    }
    public function pointLogs()
    {
        return $this->hasMany(ProductOrderPointLog::class);
    }

    public function getTotalRewardPointsAttribute()
    {
        return $this->pointLogs()->sum('points_earned');
    }

    public function getThisMonthPointsAttribute()
    {
        return $this->pointLogs()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('points_earned');
    }
}
