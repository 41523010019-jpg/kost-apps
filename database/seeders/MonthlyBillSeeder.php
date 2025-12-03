<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MonthlyBill;
use App\Models\Booking;
use Carbon\Carbon;

class MonthlyBillSeeder extends Seeder
{
    public function run(): void
    {
        $booking = Booking::first();

        if (!$booking) return;

        // Tagihan bulan pertama
        MonthlyBill::create([
            'booking_id' => $booking->id,
            'amount' => 750000,
            'due_date' => Carbon::now()->addDays(7),
            'status' => 'pending'
        ]);

        // Tagihan bulan kedua
        MonthlyBill::create([
            'booking_id' => $booking->id,
            'amount' => 750000,
            'due_date' => Carbon::now()->addMonth()->addDays(7),
            'status' => 'pending'
        ]);
    }
}
