<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyBill extends Model
{
    protected $fillable = [
        'booking_id', 'amount', 'due_date', 'status'
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'bill_id');
    }
}
