<div class="relative mb-6 w-full">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <flux:heading size="xl" level="1">{{ __('Manajemen User') }}</flux:heading>
            <flux:subheading size="lg">{{ __('Kelola data user aplikasi') }}</flux:subheading>
        </div>

        <div class="flex justify-start md:justify-end">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('dashboard') }}" separator="slash">Home</flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="#" separator="slash">Master Data</flux:breadcrumbs.item>
                <flux:breadcrumbs.item separator="slash">User</flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>
    </div>

    <flux:separator variant="subtle" />

    {{-- Tombol Create --}}
    <flux:modal.trigger name="create-user">
        <flux:button class="mt-3">Tambah User</flux:button>
    </flux:modal.trigger>

    {{-- Alert Success --}}
    @if (session()->has('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => { show = false }, 3000)"
        class="fixed top-5 right-5 bg-green-600 text-white text-sm p-4 rounded-lg shadow-lg z-50"
        role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    {{-- Modal create & edit --}}
    <livewire:backend.user.create />
    <livewire:backend.user.edit />

    {{-- Tabel User --}}
    <div class="mt-8 overflow-x-auto">
        <div class="overflow-x-auto rounded-xl shadow-md border border-gray-200 dark:border-neutral-700">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 rounded-lg shadow-md overflow-hidden">
                <thead class="bg-gray-50 dark:bg-neutral-900 text-gray-700 dark:text-gray-100 text-sm uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Nama</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Phone</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="bg-white dark:bg-neutral-950 divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse ($users as $index => $user)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">
                            {{ $users->firstItem() + $index }}
                        </td>

                        <td class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-gray-100">
                            @if($user->hasRole('admin'))
                            <span class="inline-block px-2 py-1 text-xs font-semibold text-white bg-red-500 rounded-full">
                                {{ $user->name }} (Admin)
                            </span>
                            @else
                            {{ $user->name }}
                            @endif
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">
                            {{ $user->email }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">
                            {{ $user->phone ?? '-' }}
                        </td>

                        <td class="px-6 py-4 text-center space-x-2">
                            {{-- Edit --}}
                            <button wire:click="edit({{ $user->id }})"
                                title="Edit"
                                class="text-green-500 hover:text-green-700 transition">
                                <flux:icon.pencil-square variant="mini" class="size-5" />
                            </button>

                            {{-- Hapus --}}
                            <button wire:click="delete({{ $user->id }})"
                                title="Hapus"
                                class="text-red-500 hover:text-red-700 transition">
                                <flux:icon.trash variant="mini" class="size-5" />
                            </button>

                            {{-- Disable hanya untuk user dengan booking aktif --}}
                            @if($user->bookings->count() > 0)
                            <button wire:click="disable({{ $user->id }})"
                                title="Disable User"
                                class="text-yellow-500 hover:text-yellow-700 transition">
                                <flux:icon.pause variant="mini" class="size-5" />
                            </button>
                            @endif
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            Belum ada data user.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>

        {{-- MODAL DELETE --}}
        <flux:modal name="delete-user" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Hapus User?</flux:heading>
                    <flux:text class="mt-2">
                        <p>Anda yakin ingin menghapus user ini?</p>
                        <p>Tindakan ini tidak dapat dikembalikan.</p>
                    </flux:text>
                </div>

                <div class="flex gap-2">
                    <flux:spacer />
                    <flux:modal.close>
                        <flux:button variant="ghost">Batal</flux:button>
                    </flux:modal.close>

                    <flux:button type="submit" variant="danger" wire:click="deleteUser">
                        Hapus
                    </flux:button>
                </div>
            </div>
        </flux:modal>
    </div>
</div>