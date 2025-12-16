<?php

namespace App\Livewire\Backend\Booking;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Booking;
use App\Models\MonthlyBill;
use App\Models\Payment;
use Livewire\Attributes\Title;
use Carbon\Carbon;
use Midtrans\Config;
use Midtrans\Snap;
use App\Services\MidtransConfig;


class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';
    protected $listeners = ['paymentUpdated' => 'refreshBookings'];

    #[Title('Daftar Booking User')]
    public function render()
    {
        $query = Booking::with(['room', 'user', 'bills.payment'])->latest();

        if (!auth()->user()->hasRole('admin')) {
            $query->where('user_id', auth()->id());
        }

        $bookings = $query->paginate(5);

        foreach ($bookings as $booking) {
            $this->ensureNextBilling($booking);
        }

        return view('livewire.backend.booking.index', compact('bookings'));
    }

    /**
     * ===============================
     * ADMIN KONFIRMASI BAYAR CASH
     * ===============================
     */
    public function markAsPaidCash($billId)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized');
        }

        $bill = MonthlyBill::findOrFail($billId);
        $booking = $bill->booking;

        // Update status tagihan
        $bill->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        // Update atau create payment cash
        $bill->payment()->updateOrCreate(
            ['bill_id' => $bill->id],
            [
                'booking_id' => $bill->booking_id,
                'amount' => $bill->amount,
                'method' => 'cash',
                'order_id' => 'CASH-' . $bill->id,
                'snap_token' => null,
                'transaction_status' => 'settlement', // cash confirmed = settlement
            ]
        );

        /*
    ==============================================
    UPDATE BOOKING DAN ROOM
    ==============================================
    */

        // 1. Set booking ACTIVE jika pembayaran sudah dikonfirmasi
        $booking->update([
            'status' => 'active'
        ]);

        // 2. Set room jadi TIDAK tersedia
        if ($booking->room) {
            $booking->room->update([
                'is_available' => 0
            ]);
        }

        // 3. Buat tagihan berikutnya
        $this->ensureNextBilling($booking);

        session()->flash('message', 'Pembayaran CASH dikonfirmasi dan kamar diaktifkan.');

        $this->resetPage();
    }


    /**
     * ===============================
     * ADMIN KONFIRMASI BAYAR (CASH)
     * ===============================
     */
    public function markAsPaid($billId)
    {
        return $this->markAsPaidCash($billId);
    }

    private function resyncNextBillingDate(Booking $booking)
    {
        $lastBill = $booking->bills()->orderBy('due_date', 'desc')->first();

        if (!$lastBill) {
            return;
        }

        $booking->next_billing_date = Carbon::parse($lastBill->due_date)->addMonth();
        $booking->save();
    }

    /**
     * ===================================
     * ADMIN MENGHAPUS TAGIHAN
     * ===================================
     */
    public function deleteBill($billId)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized');
        }

        $bill = MonthlyBill::findOrFail($billId);
        $booking = $bill->booking;

        if ($bill->payment) {
            $bill->payment()->delete();
        }

        $bill->delete();

        $this->resyncNextBillingDate($booking);
        $this->ensureNextBilling($booking);

        session()->flash('message', 'Tagihan berhasil dihapus.');
        $this->resetPage();
    }

    public function refreshBookings()
    {
        $this->emitSelf('refresh');
    }

    /**
     * ===================================
     * LOGIKA PEMBUATAN TAGIHAN BARU
     * ===================================
     */
    private function ensureNextBilling(Booking $booking)
    {
        if (!$booking->next_billing_date || $booking->status !== 'active') {
            return;
        }

        $nextBillingDate = Carbon::parse($booking->next_billing_date)->startOfDay();

        if ($booking->bills()->whereDate('due_date', $nextBillingDate)->exists()) {
            return;
        }

        $lastBill = $booking->bills()->latest('due_date')->first();
        if ($lastBill && $lastBill->status !== 'paid') {
            return;
        }

        MonthlyBill::create([
            'booking_id' => $booking->id,
            'amount' => $booking->room->price,
            'due_date' => $nextBillingDate,
            'status' => 'unpaid',
        ]);

        $booking->update([
            'next_billing_date' => $nextBillingDate->copy()->addMonth()
        ]);
    }

    /**
     * ===============================
     * PEMBAYARAN MIDTRANS
     * ===============================
     */
    public function generateSnapToken(MonthlyBill $bill)
    {
        $midtrans = MidtransConfig::get();

        Config::$serverKey    = $midtrans['server_key'];
        Config::$isProduction = $midtrans['is_production'];
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        $orderId = 'BOOKING-' . $bill->id . '-' . time();

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $bill->amount,
            ],
            'customer_details' => [
                'first_name' => $bill->booking->user->name,
                'email'      => $bill->booking->user->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        $bill->payment()->updateOrCreate(
            ['bill_id' => $bill->id],
            [
                'booking_id'         => $bill->booking_id,
                'amount'             => $bill->amount,
                'method'             => 'midtrans',
                'order_id'           => $orderId,
                'snap_token'         => $snapToken,
                'transaction_status' => 'pending',
            ]
        );

        $this->dispatch('payAgain', token: $snapToken);
    }
}
