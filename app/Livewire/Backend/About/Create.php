<?php

namespace App\Livewire\Backend\About;

use App\Models\About;
use Flux\Flux;
use Livewire\Component;

class Create extends Component
{
    public $title = '';
    public $description = '';

    protected $rules = [
        'title' => 'required|string|max:150',
        'description' => 'required|string',
    ];

    public function save()
    {
        $this->validate();

        About::create([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        // Reset input
        $this->reset(['title', 'description']);

        // Tutup modal dan kirim event
        $this->dispatch('aboutCreated');
        Flux::modal('create-about')->close();

        // Flash message
        session()->flash('success', 'Data About berhasil ditambahkan.');

        // Redirect ke index About
        $this->redirectRoute('dashboard.about.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.backend.about.create');
    }
}
