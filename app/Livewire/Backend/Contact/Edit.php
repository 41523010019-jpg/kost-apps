<?php

namespace App\Livewire\Backend\Contact;

use App\Models\Contact;
use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;

class Edit extends Component
{
    public $contactId;

    public $title;
    public $description;
    public $address;
    public $address_note;
    public $phone;
    public $phone_note;
    public $email;
    public $map_embed;
    public $is_active = true;

    #[On('edit-contact')]
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);

        $this->contactId    = $contact->id;
        $this->title        = $contact->title;
        $this->description  = $contact->description;
        $this->address      = $contact->address;
        $this->address_note = $contact->address_note;
        $this->phone        = $contact->phone;
        $this->phone_note   = $contact->phone_note;
        $this->email        = $contact->email;
        $this->map_embed    = $contact->map_embed;
        $this->is_active    = $contact->is_active;

        Flux::modal('edit-contact')->show();
    }

    public function update()
    {
        $this->validate([
            'title'         => 'nullable|string|max:150',
            'description'   => 'nullable|string',
            'address'       => 'required|string',
            'address_note'  => 'nullable|string',
            'phone'         => 'required|string|max:30',
            'phone_note'    => 'nullable|string|max:100',
            'email'         => 'required|email',
            'map_embed'     => 'nullable|string',
            'is_active'     => 'boolean',
        ]);

        $contact = Contact::findOrFail($this->contactId);

        // Pastikan hanya satu contact aktif (opsional tapi direkomendasikan)
        if ($this->is_active) {
            Contact::where('id', '!=', $contact->id)
                ->update(['is_active' => false]);
        }

        $contact->update([
            'title'         => $this->title,
            'description'   => $this->description,
            'address'       => $this->address,
            'address_note'  => $this->address_note,
            'phone'         => $this->phone,
            'phone_note'    => $this->phone_note,
            'email'         => $this->email,
            'map_embed'     => $this->map_embed,
            'is_active'     => $this->is_active,
        ]);

        session()->flash('success', 'Data Contact berhasil diperbarui.');

        Flux::modal('edit-contact')->close();

        $this->reset();

        // Redirect ke halaman Contact
        $this->redirectRoute('dashboard.contacts.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.backend.contact.edit');
    }
}
