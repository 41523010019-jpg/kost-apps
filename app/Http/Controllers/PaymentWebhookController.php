<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class PaymentWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Ambil raw JSON dari Midtrans
        $payload = $request->json()->all();

        // Optional: log payload untuk debugging
        Log::info('Midtrans Webhook: ', $payload);

        $orderId = $payload['order_id'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;

        if (!$orderId || !$transactionStatus) {
            return response()->json(['message' => 'Invalid payload'], 400);
        }

        // Cari payment berdasarkan order_id
        $payment = Payment::where('order_id', $orderId)->first();
        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        // Update status payment
        $payment->transaction_status = $transactionStatus;
        $payment->save();

        // Ambil relasi bill dan booking
        $bill = $payment->bill;
        $booking = $payment->booking;
        $room = $booking?->room;

        // Handle payment sukses
        if (in_array($transactionStatus, ['capture', 'settlement'])) {
            if ($bill) {
                $bill->status = 'paid';
                $bill->save();
            }

            if ($booking) {
                $booking->status = 'active';
                $booking->save();
            }

            if ($room) {
                $room->is_available = 0; // 0 = penuh
                $room->save();
            }
        } 
        // Handle payment pending
        elseif ($transactionStatus === 'pending') {
            if ($bill) {
                $bill->status = 'pending';
                $bill->save();
            }

            if ($booking) {
                $booking->status = 'pending';
                $booking->save();
            }
        } 
        // Handle payment gagal/batal/cancel/expire
        elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
            if ($bill) {
                $bill->status = 'unpaid';
                $bill->save();
            }

            if ($booking) {
                $booking->status = 'pending';
                $booking->save();
            }

            if ($room) {
                $room->is_available = 1; // 1 = tersedia kembali
                $room->save();
            }
        }

        return response()->json(['message' => 'OK']);
    }
}
