<?php

namespace App\Livewire\Backend\Hero;

use App\Models\Hero;
use Flux\Flux;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $heroId;
    public $order;
    public $newImage;
    public $existingImage;

    #[On('edit-hero')]
    public function edit($id)
    {
        $hero = Hero::findOrFail($id);

        $this->heroId        = $hero->id;
        $this->order         = $hero->order;
        $this->existingImage = $hero->image;

        Flux::modal('edit-hero')->show();
    }

    public function update()
    {
        $this->validate([
            'order'    => 'required|integer|min:1',
            'newImage' => 'nullable|image|max:2048',
        ]);

        $hero = Hero::findOrFail($this->heroId);

        // Jika upload gambar baru
        if ($this->newImage) {

            // Hapus gambar lama
            if ($hero->image && Storage::disk('public')->exists($hero->image)) {
                Storage::disk('public')->delete($hero->image);
            }

            $path = $this->newImage->store('heroes', 'public');
            $hero->image = $path;
        }

        $hero->order = $this->order;
        $hero->save();

        session()->flash('success', 'Hero berhasil diperbarui.');

        Flux::modal('edit-hero')->close();

        // Reset state setelah update
        $this->reset();

        $this->redirectRoute('dashboard.heroes.index', navigate: true);
    }

    public function deleteImage()
    {
        $hero = Hero::findOrFail($this->heroId);

        // Hapus file dari storage
        if ($hero->image && Storage::disk('public')->exists($hero->image)) {
            Storage::disk('public')->delete($hero->image);
        }

        // Hapus dari database
        $hero->update(['image' => null]);

        // Update UI
        $this->existingImage = null;

        session()->flash('success', 'Gambar berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.backend.hero.edit');
    }
}
