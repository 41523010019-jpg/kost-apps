<?php

namespace App\Livewire\Backend\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Flux\Flux;
use Livewire\Attributes\Title;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    use WithPagination;

    public $userId;

    /**
     * Trigger edit modal
     */
    public function edit($id)
    {
        $this->dispatch('edit-user', $id);
    }

    /**
     * Buka modal delete
     */
    public function delete($id)
    {
        $this->userId = $id;
        Flux::modal('delete-user')->show();
    }

    /**
     * Hapus data user
     */
    public function deleteUser()
    {
        $user = User::findOrFail($this->userId);
        $user->delete();

        Flux::modal('delete-user')->close();
        session()->flash('success', 'Data user berhasil dihapus.');
    }


    public function disable($id)
    {
        DB::transaction(function () use ($id) {
            $user = User::findOrFail($id);

            Log::info("Admin mencoba menonaktifkan user: {$user->id} - {$user->name}");

            // Ambil semua booking aktif user (paid / pending)
            $activeBookings = Booking::where('user_id', $id)
                ->whereIn('status', ['pending', 'active'])
                ->get();

            if ($activeBookings->isEmpty()) {
                Log::info("Tidak ada booking aktif untuk user: {$user->id}");
            }

            foreach ($activeBookings as $booking) {
                // Batalkan semua pembayaran terkait
                $booking->payments()->update([
                    'transaction_status' => 'cancelled'
                ]);
                Log::info("Pembayaran booking ID {$booking->id} dibatalkan.");

                // Ubah status booking menjadi expired
                $booking->update([
                    'status' => 'expired'
                ]);
                Log::info("Booking ID {$booking->id} diubah statusnya menjadi expired.");

                // Set kamar menjadi tersedia
                if ($booking->room) {
                    $booking->room->update([
                        'is_available' => 1
                    ]);
                    Log::info("Kamar ID {$booking->room->id} dikembalikan menjadi tersedia.");
                }
            }

            // Opsional: tandai user sebagai disabled
            // $user->update(['status' => 'disabled']);
            Log::info("User ID {$user->id} dinonaktifkan.");
        });

        session()->flash('success', 'User telah dinonaktifkan dan semua booking dihentikan.');
    }

    #[Title('Manajemen User')]
    public function render()
    {
        $users = User::with(['bookings' => function ($q) {
            $q->whereIn('status', ['active', 'pending']);
        }])->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.backend.user.index', [
            'users' => $users,
        ]);
    }
}
