<?php

namespace App\Livewire\Backend\Category;

use App\Models\Category;
use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;

class Edit extends Component
{
    public $categoryId;
    public $name;

    #[On('edit-category')]
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        $this->categoryId = $category->id;
        $this->name       = $category->name;

        Flux::modal('edit-category')->show();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:150',
        ]);

        $category = Category::findOrFail($this->categoryId);

        $category->update([
            'name' => $this->name,
        ]);

        session()->flash('success', 'Kategori berhasil diperbarui.');

        Flux::modal('edit-category')->close();

        $this->reset();

        // Redirect ke halaman category
        $this->redirectRoute('dashboard.categories.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.backend.category.edit');
    }
}
