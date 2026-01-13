<?php

namespace App\Livewire\Backend\Facility;

use App\Models\Facility;
use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;

class Edit extends Component
{
    public $facilityId;
    public $name;
    public $icon;

    #[On('edit-facility')]
    public function edit($id)
    {
        $facility = Facility::findOrFail($id);

        $this->facilityId = $facility->id;
        $this->name       = $facility->name;
        $this->icon       = $facility->icon;

        Flux::modal('edit-facility')->show();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:150',
            'icon' => 'nullable|string',
        ]);

        $facility = Facility::findOrFail($this->facilityId);

        $facility->update([
            'name' => $this->name,
            'icon' => $this->icon,
        ]);

        session()->flash('success', 'Data fasilitas berhasil diperbarui.');

        Flux::modal('edit-facility')->close();

        $this->reset();

        // Redirect ke halaman facility
        $this->redirectRoute('dashboard.facility.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.backend.facility.edit');
    }
}
