<?php

namespace App\Livewire\Backend\Room;

use App\Models\Room;
use App\Models\Category;
use App\Models\RoomPhoto;
use Flux\Flux;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $roomId;

    public $name;
    public $price;
    public $is_available;
    public $description;
    public $category_id;

    public $categories = [];

    // Foto baru
    public $newPhotos = [];

    // Foto lama
    public $existingPhotos = [];

    /** 🔥 Load kategori saat komponen pertama kali dipanggil */
    public function mount()
    {
        $this->categories = Category::all();
    }

    #[On('edit-room')]
    public function edit($id)
    {
        $room = Room::with('photos')->findOrFail($id);

        $this->roomId       = $room->id;
        $this->name         = $room->name;
        $this->price        = $room->price;
        $this->is_available = $room->is_available;
        $this->description  = $room->description;
        $this->category_id  = $room->category_id;

        $this->existingPhotos = $room->photos->pluck('path')->toArray();

        Flux::modal('edit-room')->show();
    }

    public function update()
    {
        $this->validate([
            'name'         => 'required|string|max:150',
            'price'        => 'required|numeric|min:0',
            'is_available' => 'required|boolean',
            'description'  => 'nullable|string',
            'category_id'  => 'required|integer',
            'newPhotos.*'  => 'nullable|image|max:2048',
        ]);

        $room = Room::findOrFail($this->roomId);

        // Tambah foto baru
        if (!empty($this->newPhotos)) {
            foreach ($this->newPhotos as $photo) {
                $path = $photo->store('room_photos', 'public');
                $room->photos()->create(['path' => $path]);
            }
        }

        // Update data room
        $room->update([
            'name'         => $this->name,
            'price'        => $this->price,
            'is_available' => $this->is_available,
            'description'  => $this->description,
            'category_id'  => $this->category_id,
        ]);

        session()->flash('success', 'Room berhasil diperbarui.');

        Flux::modal('edit-room')->close();

        $this->reset();

        return $this->redirectRoute('dashboard.rooms.index', navigate: true);
    }

    public function deletePhoto($photoPath)
    {
        $room = Room::findOrFail($this->roomId);

        $photo = $room->photos()->where('path', $photoPath)->first();

        if ($photo) {

            if (Storage::disk('public')->exists($photo->path)) {
                Storage::disk('public')->delete($photo->path);
            }

            $photo->delete();
        }

        $this->existingPhotos = $room->photos()->pluck('path')->toArray();

        session()->flash('success', 'Foto berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.backend.room.edit');
    }
}
