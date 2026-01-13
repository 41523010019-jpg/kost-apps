<?php

namespace App\Livewire\Backend\Contact;

use App\Models\Contact;
use Flux\Flux;
use Livewire\Component;

class Create extends Component
{
    public $title = '';
    public $description = '';
    public $address = '';
    public $address_note = '';
    public $phone = '';
    public $phone_note = '';
    public $email = '';
    public $map_embed = '';
    public $is_active = true;

    protected $rules = [
        'title'         => 'nullable|string|max:150',
        'description'   => 'nullable|string',
        'address'       => 'required|string',
        'address_note'  => 'nullable|string',
        'phone'         => 'required|string|max:30',
        'phone_note'    => 'nullable|string|max:100',
        'email'         => 'required|email',
        'map_embed'     => 'nullable|string',
        'is_active'     => 'boolean',
    ];

    public function save()
    {
        $this->validate();

        Contact::create([
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

        // Reset input
        $this->reset();

        // Tutup modal
        Flux::modal('create-contact')->close();

        // Flash message
        session()->flash('success', 'Data Contact berhasil ditambahkan.');

        // Redirect ke index Contact
        $this->redirectRoute('dashboard.contacts.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.backend.contact.create');
    }
}
