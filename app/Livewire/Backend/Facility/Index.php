<?php

namespace App\Livewire\Backend\Facility;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Facility;
use Flux\Flux;
use Livewire\Attributes\Title;

class Index extends Component
{
    use WithPagination;

    public $facilityId;

    /**
     * Trigger edit modal
     */
    public function edit($id)
    {
        $this->dispatch('edit-facility', $id);
    }

    /**
     * Buka modal delete
     */
    public function delete($id)
    {
        $this->facilityId = $id;
        Flux::modal('delete-facility')->show();
    }

    /**
     * Hapus data facility
     */
    public function deleteFacility()
    {
        $facility = Facility::findOrFail($this->facilityId);
        $facility->delete();

        Flux::modal('delete-facility')->close();
        session()->flash('success', 'Data fasilitas berhasil dihapus.');
    }

    #[Title('Fasilitas Kos')]
    public function render()
    {
        $facilities = Facility::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.backend.facility.index', [
            'facilities' => $facilities,
        ]);
    }
}
