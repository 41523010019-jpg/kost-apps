<?php

namespace App\Livewire\Backend\User;

use App\Models\User;
use Flux\Flux;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class Create extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $gender = ''; // gender user
    public $address = '';
    public $password = '';
    public $role = 'user'; // default role

    public $roles = []; // untuk dropdown role

    protected $rules = [
        'name' => 'required|string|max:150',
        'email' => 'required|email|unique:users,email',
        'phone' => 'nullable|string|max:20',
        'gender' => 'nullable|in:male,female',
        'address' => 'nullable|string|max:255',
        'password' => 'required|string|min:6',
        'role' => 'required|in:admin,user',
    ];

    public function mount()
    {
        // Ambil role dari Spatie untuk dropdown
        $this->roles = Role::pluck('name')->toArray();
    }

    public function save()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'address' => $this->address,
            'password' => Hash::make($this->password),
        ]);

        // Set role via Spatie
        $user->assignRole($this->role);

        // Reset input
        $this->reset(['name', 'email', 'phone', 'gender', 'address', 'password', 'role']);

        // Tutup modal & kirim event
        $this->dispatch('userCreated');
        Flux::modal('create-user')->close();

        // Flash message
        session()->flash('success', 'Data user berhasil ditambahkan.');

        // Redirect ke index User
        $this->redirectRoute('dashboard.users.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.backend.user.create');
    }
}
