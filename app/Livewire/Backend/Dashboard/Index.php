<?php

namespace App\Livewire\Backend\Dashboard;

use App\Models\User;
use App\Models\Booking;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;

class Index extends Component
{
    public $jumlahPengguna;
    public $jumlahBooking;
    public $jumlahLunas;
    public $jumlahBatal;
    public $jumlahHariIni;
    public $lunasHariIni;
    public $totalBulanIni;
    public $recentBookings = [];

    public function mount()
    {
        // Total pengguna
        $this->jumlahPengguna = User::count();

        // Total booking
        $this->jumlahBooking = Booking::count();

        // Total booking yang sudah lunas (misal status 'paid')
        $this->jumlahLunas = Booking::where('status', 'paid')->count();

        // Total booking yang dibatalkan (misal status 'cancelled')
        $this->jumlahBatal = Booking::where('status', 'cancelled')->count();

        // Booking hari ini
        $this->jumlahHariIni = Booking::whereDate('created_at', Carbon::today())->count();

        // Booking yang lunas hari ini
        $this->lunasHariIni = Booking::where('status', 'paid')
            ->whereDate('created_at', Carbon::today())
            ->count();

        // Total booking bulan ini
        $this->totalBulanIni = Booking::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Recent 5 booking terbaru dengan relasi user dan room
        $this->recentBookings = Booking::with(['user', 'room'])
            ->latest()
            ->take(5)
            ->get();
    }

    #[Title('Dashboard')]
    public function render()
    {
        return view('livewire.backend.dashboard.index', [
            'jumlahPengguna' => $this->jumlahPengguna,
            'jumlahBooking' => $this->jumlahBooking,
            'jumlahLunas' => $this->jumlahLunas,
            'jumlahBatal' => $this->jumlahBatal,
            'jumlahHariIni' => $this->jumlahHariIni,
            'lunasHariIni' => $this->lunasHariIni,
            'totalBulanIni' => $this->totalBulanIni,
            'recentBookings' => $this->recentBookings,
        ]);
    }
}
