<div class="flex flex-col gap-6">
    <x-auth-header
        title="Buat Akun Baru"
        description="Masukkan data diri Anda di bawah ini untuk membuat akun" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" wire:submit="register" class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Name -->
        <flux:input
            wire:model="name"
            label="Nama Lengkap"
            type="text"
            required
            autofocus
            autocomplete="name"
            placeholder="Nama lengkap" />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            label="Alamat Email"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com" />

        <!-- Password -->
        <flux:input
            wire:model="password"
            label="Kata Sandi"
            type="password"
            required
            autocomplete="new-password"
            placeholder="Kata sandi"
            viewable />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            label="Konfirmasi Kata Sandi"
            type="password"
            required
            autocomplete="new-password"
            placeholder="Konfirmasi kata sandi"
            viewable />

        <!-- Phone Number -->
        <flux:input
            wire:model="phone"
            label="Nomor HP"
            type="text"
            required
            placeholder="08xxxxxxxxxx" />

        <!-- Gender -->
        <flux:select
            wire:model="gender"
            label="Jenis Kelamin"
            required>
            <option value="" disabled>Pilih jenis kelamin</option>
            <option value="male">Laki-laki</option>
            <option value="female">Perempuan</option>
        </flux:select>

        <!-- Address (Full Width, Not in Grid) -->
        <div class="col-span-1 md:col-span-2">
            <flux:textarea
                wire:model="address"
                label="Alamat Lengkap"
                required
                placeholder="Masukkan alamat lengkap Anda"
                class="h-32 w-full" />
        </div>

        <div class="md:col-span-2 flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                Buat Akun
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        <span>Sudah punya akun?</span>
        <flux:link :href="route('login')" wire:navigate>Masuk</flux:link>
    </div>
</div>
