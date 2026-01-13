<?php

namespace App\Livewire\Backend\Contact;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Contact;
use Flux\Flux;
use Livewire\Attributes\Title;

class Index extends Component
{
    use WithPagination;

    public $contactId;

    /**
     * Trigger edit modal
     */
    public function edit($id)
    {
        $this->dispatch('edit-contact', $id);
    }

    /**
     * Buka modal delete
     */
    public function delete($id)
    {
        $this->contactId = $id;
        Flux::modal('delete-contact')->show();
    }

    /**
     * Hapus data contact
     */
    public function deleteContact()
    {
        $contact = Contact::findOrFail($this->contactId);
        $contact->delete();

        Flux::modal('delete-contact')->close();
        session()->flash('success', 'Data Kontak berhasil dihapus.');
    }

    #[Title('Kontak Kos')]
    public function render()
    {
        $contacts = Contact::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.backend.contact.index', [
            'contacts' => $contacts,
        ]);
    }
}
