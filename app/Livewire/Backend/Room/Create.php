<?php

namespace App\Livewire\Backend\Room;

use App\Models\Category;
use App\Models\Room;
use App\Models\RoomPhoto;
use Flux\Flux;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $category_id;
    public $name;
    public $price;
    public $is_available = true;
    public $description;

    public $photos = []; // multiple upload

    protected $rules = [
        'category_id'   => 'required|exists:categories,id',
        'name'          => 'required|string|max:150',
        'price'         => 'required|numeric|min:0',
        'is_available'  => 'required|boolean',
        'description'   => 'nullable|string',
        'photos.*'      => 'nullable|image|max:2048'
    ];

    public function save()
    {
        $this->validate();

        // Simpan data kamar
        $room = Room::create([
            'category_id'  => $this->category_id,
            'name'         => $this->name,
            'price'        => $this->price,
            'is_available' => $this->is_available,
            'description'  => $this->description,
        ]);

        // Simpan foto
        if (!empty($this->photos)) {
            foreach ($this->photos as $photo) {
                $path = $photo->store('room_photos', 'public');

                RoomPhoto::create([
                    'room_id' => $room->id,
                    'path'    => $path,
                ]);
            }
        }

        // Reset input
        $this->reset();

        // Tutup modal & notif
        $this->dispatch('roomCreated');
        Flux::modal('create-room')->close();
        session()->flash('success', 'Kamar berhasil ditambahkan.');

        // Redirect
        return $this->redirectRoute('dashboard.rooms.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.backend.room.create', [
            'categories' => Category::all(),
        ]);
    }
}
