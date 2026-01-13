<div>
    <flux:modal name="edit-user" class="md:w-900">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit User</flux:heading>
                <flux:text class="mt-2">
                    Perbarui data user. Kosongkan password jika tidak ingin diubah.
                </flux:text>
            </div>

            <!-- Nama -->
            <flux:input
                label="Nama"
                wire:model="name"
                placeholder="Contoh: John Doe" />

            <!-- Email -->
            <flux:input
                label="Email"
                type="email"
                wire:model="email"
                placeholder="Contoh: john@example.com" />

            <!-- Phone -->
            <flux:input
                label="Phone"
                wire:model="phone"
                placeholder="Contoh: 08123456789" />

            <!-- Gender -->
            <flux:select
                label="Gender"
                wire:model="gender">
                <option value="">-- Pilih Gender --</option>
                <option value="male">Laki-laki</option>
                <option value="female">Perempuan</option>
            </flux:select>

            <!-- Address -->
            <flux:textarea
                label="Address"
                wire:model="address"
                rows="3"
                placeholder="Alamat lengkap user" />

            <!-- Password -->
            <flux:input
                label="Password"
                type="password"
                wire:model="password"
                placeholder="Kosongkan jika tidak ingin diubah" />

            <!-- Role -->
            <flux:select
                label="Role"
                wire:model="role">
                @foreach ($roles as $r)
                    <option value="{{ $r }}" @if($role === $r) selected @endif>{{ ucfirst($r) }}</option>
                @endforeach
            </flux:select>

            <div class="flex">
                <flux:spacer />
                <flux:button
                    type="submit"
                    variant="primary"
                    wire:click="update">
                    Update User
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
