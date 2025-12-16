<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'booking_id', 'bill_id', 'amount', 'method',
        'order_id', 'transaction_status', 'snap_token', 'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function bill() {
        return $this->belongsTo(MonthlyBill::class, 'bill_id');
    }

    public function booking() {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
