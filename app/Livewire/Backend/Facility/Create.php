<?php

namespace App\Livewire\Backend\Facility;

use App\Models\Facility;
use Flux\Flux;
use Livewire\Component;

class Create extends Component
{
    public $name = '';
    public $icon = '';

    protected $rules = [
        'name' => 'required|string|max:150',
        'icon' => 'nullable|string',
    ];

    public function save()
    {
        $this->validate();

        Facility::create([
            'name' => $this->name,
            'icon' => $this->icon,
        ]);

        // Reset input
        $this->reset(['name', 'icon']);

        // Tutup modal & kirim event
        $this->dispatch('facilityCreated');
        Flux::modal('create-facility')->close();

        // Flash message
        session()->flash('success', 'Data fasilitas berhasil ditambahkan.');

        // Redirect ke index Facility
        $this->redirectRoute('dashboard.facility.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.backend.facility.create');
    }
}
