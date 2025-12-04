<?php

namespace App\Livewire\Backend\Hero;

use Livewire\Component;
use App\Models\Hero;
use Flux\Flux;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    public $heroId;

    public function edit($id)
    {
        $this->dispatch('edit-hero', $id);
    }

    public function delete($id)
    {
        $this->heroId = $id;
        Flux::modal('delete-hero')->show();
    }

    public function deleteHero()
    {
        $hero = Hero::findOrFail($this->heroId);

        if ($hero->image && Storage::disk('public')->exists($hero->image)) {
            Storage::disk('public')->delete($hero->image);
        }

        $hero->delete();

        Flux::modal('delete-hero')->close();
        session()->flash('success', 'Hero berhasil dihapus.');
    }

    #[Title('Daftar Hero')]
    public function render()
    {
        return view('livewire.backend.hero.index', [
            'heroes' => Hero::orderBy('order')->paginate(5),
        ]);
    }
}
