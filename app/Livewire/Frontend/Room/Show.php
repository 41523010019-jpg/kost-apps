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

#[Layout('layouts.home')]
class Show extends Component
{
    public Room $room;
    public $start_date;

    public function mount(Room $room)
    {
        $this->room = $room->load('photos', 'category.pricePackages');
    }

    public function createBooking($roomId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melanjutkan.');
        }

        // VALIDASI
        $this->validate([
            'start_date' => 'required|date|after_or_equal:today'
        ]);

        // CEK STATUS KAMAR
        if (!$this->room->is_available) {
            session()->flash('error', 'Kamar tidak tersedia.');
            return;
        }

        // 1. BUAT BOOKING
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $roomId,
            'start_date' => $this->start_date,
            'next_billing_date' => now()->addMonth(),
            'status' => 'pending',
        ]);

        // 2. AMBIL PACKAGE POPULER
        // 2. AMBIL HARGA KAMAR LANGSUNG DARI TABLE ROOMS
        $roomPrice = $this->room->price;

        $bill = MonthlyBill::create([
            'booking_id' => $booking->id,
            'amount' => $roomPrice,
            'due_date' => now(),
            'status' => 'pending',
        ]);


        // 3. MIDTRANS CONFIG
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $orderId = 'KOS-' . $bill->id . '-' . time();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $bill->amount,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        // 4. SIMPAN PAYMENT
        Payment::create([
            'booking_id' => $booking->id,
            'bill_id' => $bill->id,
            'amount' => $bill->amount,
            'method' => 'midtrans',
            'order_id' => $orderId,
            'transaction_status' => 'pending',
            'snap_token' => $snapToken,
        ]);

        // 5. KIRIM EVENT KE JAVASCRIPT
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
