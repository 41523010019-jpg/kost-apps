<?php

namespace App\Livewire\Backend\About;

use App\Models\About;
use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;

class Edit extends Component
{
    public $aboutId;
    public $title;
    public $description;

    #[On('edit-about')]
    public function edit($id)
    {
        $about = About::findOrFail($id);

        $this->aboutId     = $about->id;
        $this->title       = $about->title;
        $this->description = $about->description;

        Flux::modal('edit-about')->show();
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:150',
            'description' => 'required|string',
        ]);

        $about = About::findOrFail($this->aboutId);

        $about->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Data About berhasil diperbarui.');

        Flux::modal('edit-about')->close();

        $this->reset();

        // Redirect ke halaman about
        $this->redirectRoute('dashboard.about.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.backend.about.edit');
    }
}
