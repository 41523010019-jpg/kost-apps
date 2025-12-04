<?php

namespace App\Livewire\Frontend\Room;

use App\Models\Category;
use App\Models\Room;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.home')]
class Index extends Component
{
    use WithPagination;

    public $selectedCategory = null;

    public function updatedSelectedCategory()
    {
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->selectedCategory = null;
        $this->resetPage();
    }

    public function render()
    {
        // hitung total kamar per kategori
        $categories = Category::withCount('rooms')->get();

        // ambil kamar berdasarkan kategori yang dipilih
        $rooms = Room::with(['photos', 'category'])
            ->when($this->selectedCategory, function ($query) {
                $query->whereHas('category', function ($q) {
                    $q->where('slug', $this->selectedCategory);
                });
            })
            ->paginate(6);

        return view('livewire.frontend.room.index', [
            'rooms' => $rooms,
            'categories' => $categories
        ]);
    }
}
