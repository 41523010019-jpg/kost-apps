<?php

namespace App\Livewire\Backend\Room;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Room;
use Flux\Flux;
use Livewire\Attributes\Title;

class Index extends Component
{
    use WithPagination;

    public $roomId;

    /**
     * Trigger edit modal
     */
    public function edit($id)
    {
        $this->dispatch('edit-room', $id); 
    }

    /**
     * Buka modal delete
     */
    public function delete($id)
    {
        $this->roomId = $id;
        Flux::modal('delete-room')->show();
    }

    /**
     * Hapus Room
     */
    public function deleteRoom()
    {
        $room = Room::findOrFail($this->roomId);
        $room->delete();

        Flux::modal('delete-room')->close();
        session()->flash('success', 'Kamar berhasil dihapus.');
    }

    #[Title('Daftar Kamar')]
    public function render()
    {
        $rooms = Room::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.backend.room.index', [
            'rooms' => $rooms,
        ]);
    }
}
