<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\MonthlyBill;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $bill = MonthlyBill::first();

        if (!$bill) return;

        // Cash Payment (Lunas)
        Payment::create([
            'booking_id' => $bill->booking_id,
            'bill_id' => $bill->id,
            'amount' => $bill->amount,
            'method' => 'cash',
            'order_id' => null,
            'transaction_status' => 'paid',
            'snap_token' => null,
            'paid_at' => Carbon::now(),
        ]);

        // Midtrans (pending)
        Payment::create([
            'booking_id' => $bill->booking_id,
            'bill_id' => $bill->id,
            'amount' => $bill->amount,
            'method' => 'midtrans',
            'order_id' => 'ORDER-' . uniqid(),
            'transaction_status' => 'pending',
            'snap_token' => 'dummy-snap-token',
            'paid_at' => null,
        ]);
    }
}
