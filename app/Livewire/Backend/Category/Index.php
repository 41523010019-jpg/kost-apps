<?php

namespace App\Livewire\Backend\Category;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;
use Flux\Flux;
use Livewire\Attributes\Title;

class Index extends Component
{
    use WithPagination;

    public $categoryId;

    /**
     * Trigger edit modal
     */
    public function edit($id)
    {
        $this->dispatch('edit-category', $id); 
    }

    /**
     * Buka modal delete
     */
    public function delete($id)
    {
        $this->categoryId = $id;
        Flux::modal('delete-category')->show();
    }

    /**
     * Hapus kategori
     */
    public function deleteCategory()
    {
        $category = Category::findOrFail($this->categoryId);
        $category->delete();

        Flux::modal('delete-category')->close();
        session()->flash('success', 'Kategori berhasil dihapus.');
    }

    #[Title('Daftar Kategori')]
    public function render()
    {
        $categories = Category::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.backend.category.index', [
            'categories' => $categories,
        ]);
    }
}
