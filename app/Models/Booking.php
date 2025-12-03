<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'room_id', 'start_date', 'next_billing_date', 'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'next_billing_date' => 'date',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function bills()
    {
        return $this->hasMany(MonthlyBill::class);
    }
}
