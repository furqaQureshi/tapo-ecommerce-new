<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTrackingHistory extends Model
{
    protected $table = 'order_tracking_history';
    protected $fillable = [
        'order_id',
        'tracking_no',
        'process',
        'type',
        'date',
        'office',
        'error_details',
        'event_type',
        'failure_reason',
        'epod',
        'source',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
