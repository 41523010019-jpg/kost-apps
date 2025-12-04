<?php

namespace App\Livewire\Backend\Hero;

use App\Models\Hero;
use Flux\Flux;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $image;
    public $order;

    protected $rules = [
        'image' => 'required|image|max:2048', // max 2MB
        'order' => 'required|integer|min:0',
    ];

    public function save()
    {
        $this->validate();

        // Simpan file gambar
        $path = $this->image->store('heroes', 'public');

        // Simpan data ke database
        Hero::create([
            'image' => $path,
            'order' => $this->order,
        ]);

        // Reset input
        $this->reset();

        // Tutup modal dan notifikasi
        $this->dispatch('heroCreated');
        Flux::modal('create-hero')->close();
        session()->flash('success', 'Hero berhasil ditambahkan.');

        // Redirect ke index
        $this->redirectRoute('dashboard.heroes.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.backend.hero.create');
    }
}
