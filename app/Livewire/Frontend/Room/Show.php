<?php

namespace App\Livewire\Frontend\Room;

use App\Models\Booking;
use App\Models\Room;
use App\Models\MonthlyBill;
use App\Models\Payment;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Auth;
use App\Services\MidtransConfig;


#[Layout('layouts.home')]
class Show extends Component
{
    public Room $room;
    public $start_date;
    public $payment_method;


    public function mount(Room $room)
    {
        $this->room = $room->load('photos', 'category.pricePackages');
    }

    public function createBooking($roomId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melanjutkan.');
        }

        $this->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'payment_method' => 'required|in:cash,midtrans'
        ]);

        if (!$this->room->is_available) {
            session()->flash('error', 'Kamar tidak tersedia.');
            return;
        }

        // 1. CREATE BOOKING
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $roomId,
            'start_date' => $this->start_date,
            'next_billing_date' => now()->addMonth(),
            'status' => 'pending', // SEMUA mulai dari pending
        ]);

        $roomPrice = $this->room->price;

        // 2. CREATE FIRST BILL
        $bill = MonthlyBill::create([
            'booking_id' => $booking->id,
            'amount'      => $roomPrice,
            'due_date'    => now(),
            'status'      => 'pending', // cash juga pending
        ]);

        /*
    ==========================================
      IF PAYMENT METHOD = CASH
      → Booking tetap PENDING (admin yang aktifkan)
      → Bill tetap PENDING
      → Payment tercatat pending
    ==========================================
    */
        if ($this->payment_method === 'cash') {

            // Generate order_id untuk cash
            $orderId = 'CASH-' . $bill->id . '-' . time();

            Payment::create([
                'booking_id' => $booking->id,
                'bill_id'    => $bill->id,
                'amount'     => $bill->amount,
                'method'     => 'cash',
                'order_id'   => $orderId, // <-- sudah diisi
                'transaction_status' => 'pending',
                'snap_token' => null,
            ]);

            session()->flash('success', 'Booking berhasil dibuat. Silakan selesaikan pembayaran ke admin.');
            return redirect()->route('dashboard.bookings.index');
        }


        /*
    ==========================================
      IF PAYMENT METHOD = MIDTRANS
    ==========================================
    */
        $midtrans = MidtransConfig::get();

        Config::$serverKey    = $midtrans['server_key'];
        Config::$isProduction = $midtrans['is_production'];
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        $orderId = 'KOS-' . $bill->id . '-' . time();

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $bill->amount,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email'      => Auth::user()->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        // Simpan payment MIDTRANS Pending
        Payment::create([
            'booking_id' => $booking->id,
            'bill_id'    => $bill->id,
            'amount'     => $bill->amount,
            'method'     => 'midtrans',
            'order_id'   => $orderId,
            'transaction_status' => 'pending',
            'snap_token' => $snapToken,
        ]);

        // Buka popup Snap
        $this->dispatch('open-snap', snapToken: $snapToken);
    }



    public function render()
    {
        $package = $this->room->category->pricePackages
            ->where('is_popular', true)
            ->first()
            ?? $this->room->category->pricePackages->first();

        $relatedRooms = Room::with('photos')
            ->where('category_id', $this->room->category_id)
            ->where('id', '!=', $this->room->id)
            ->limit(3)
            ->get();

        return view('livewire.frontend.room.show', [
            'package' => $package,
            'relatedRooms' => $relatedRooms,
        ]);
    }
}
