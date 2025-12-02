<?php

namespace App\Livewire\Backend\Category;

use App\Models\Category;
use Flux\Flux;
use Livewire\Component;

class Create extends Component
{
    public $name = '';

    protected $rules = [
        'name' => 'required|string|max:150',
    ];

    public function save()
    {
        $this->validate();

        Category::create([
            'name' => $this->name,
        ]);

        // Reset input
        $this->reset('name');

        // Tutup modal dan kirim event
        $this->dispatch('categoryCreated');
        Flux::modal('create-category')->close();

        // Flash message
        session()->flash('success', 'Kategori berhasil ditambahkan.');

        // Redirect ke index
        $this->redirectRoute('dashboard.categories.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.backend.category.create');
    }
}
