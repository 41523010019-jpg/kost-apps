<?php

namespace App\Livewire\Backend\User;

use App\Models\User;
use Flux\Flux;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;

class Edit extends Component
{
    public $userId;
    public $name;
    public $email;
    public $phone;
    public $gender;
    public $address;
    public $password;
    public $role;

    public $roles = [];

    #[On('edit-user')]
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $this->userId  = $user->id;
        $this->name    = $user->name;
        $this->email   = $user->email;
        $this->phone   = $user->phone;
        $this->gender  = $user->gender;
        $this->address = $user->address;
        $this->role    = $user->getRoleNames()->first() ?? 'user';

        // Ambil semua role untuk dropdown
        $this->roles = Role::pluck('name')->toArray();

        Flux::modal('edit-user')->show();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female',
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:admin,user',
        ]);

        $user = User::findOrFail($this->userId);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'address' => $this->address,
        ];

        // Update password hanya jika diisi
        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        $user->update($data);

        // Update role via Spatie
        $user->syncRoles([$this->role]);

        session()->flash('success', 'Data user berhasil diperbarui.');

        Flux::modal('edit-user')->close();

        $this->reset();

        // Redirect ke halaman user
        $this->redirectRoute('dashboard.users.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.backend.user.edit');
    }
}
