<?php

namespace App\Livewire\Backend\About;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\About;
use Flux\Flux;
use Livewire\Attributes\Title;

class Index extends Component
{
    use WithPagination;

    public $aboutId;

    /**
     * Trigger edit modal
     */
    public function edit($id)
    {
        $this->dispatch('edit-about', $id); 
    }

    /**
     * Buka modal delete
     */
    public function delete($id)
    {
        $this->aboutId = $id;
        Flux::modal('delete-about')->show();
    }

    /**
     * Hapus data about
     */
    public function deleteAbout()
    {
        $about = About::findOrFail($this->aboutId);
        $about->delete();

        Flux::modal('delete-about')->close();
        session()->flash('success', 'Data About berhasil dihapus.');
    }

    #[Title('Tentang Kos')]
    public function render()
    {
        $abouts = About::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.backend.about.index', [
            'abouts' => $abouts,
        ]);
    }
}
