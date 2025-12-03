<div class="relative mb-6 w-full">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <flux:heading size="xl" level="1">{{ __('Paket Harga') }}</flux:heading>
            <flux:subheading size="lg">{{ __('Kelola paket harga kos') }}</flux:subheading>
        </div>

        <div class="flex justify-start md:justify-end">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('dashboard') }}" separator="slash">Home</flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="#" separator="slash">Master Data</flux:breadcrumbs.item>
                <flux:breadcrumbs.item separator="slash">Paket Harga</flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>
    </div>

    <flux:separator variant="subtle" />

    {{-- Tombol Create --}}
    <flux:modal.trigger name="create-pricepackage">
        <flux:button class="mt-3">Tambah Paket Harga</flux:button>
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
    <livewire:backend.price-package.create />
    <livewire:backend.price-package.edit />

    <!-- Tabel Paket Harga -->
    <div class="mt-8 overflow-x-auto">
        <div class="overflow-x-auto rounded-xl shadow-md border border-gray-200 dark:border-neutral-700">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 rounded-lg shadow-md overflow-hidden">
                <thead class="bg-gray-50 dark:bg-neutral-900 text-gray-700 dark:text-gray-100 text-sm uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Nama Paket</th>
                        <th class="px-6 py-3 text-left">Harga</th>
                        <th class="px-6 py-3 text-left">Fasilitas</th>
                        <th class="px-6 py-3 text-center">Populer?</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="bg-white dark:bg-neutral-950 divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse ($packages as $index => $package)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">
                                {{ $packages->firstItem() + $index }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                {{ $package->category->name }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">
                                Rp {{ number_format($package->price_per_month, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">
                                <ul class="list-disc ml-4">
                                    @foreach ($package->facilities ?? [] as $f)
                                        <li>{{ $f }}</li>
                                    @endforeach
                                </ul>
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if ($package->is_popular)
                                    <span class="px-2 py-1 text-xs bg-green-600 text-white rounded">Ya</span>
                                @else
                                    <span class="px-2 py-1 text-xs bg-gray-300 dark:bg-neutral-700 rounded">Tidak</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center space-x-2">
                                {{-- Edit --}}
                                <button wire:click="edit({{ $package->id }})"
                                    title="Edit"
                                    class="text-green-500 hover:text-green-700 transition">
                                    <flux:icon.pencil-square variant="mini" class="size-5" />
                                </button>

                                {{-- Delete --}}
                                <button wire:click="delete({{ $package->id }})"
                                    title="Hapus"
                                    class="text-red-500 hover:text-red-700 transition">
                                    <flux:icon.trash variant="mini" class="size-5" />
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                Belum ada paket harga.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $packages->links() }}
        </div>

        {{-- MODAL DELETE --}}
        <flux:modal name="delete-pricepackage" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Hapus Paket Harga?</flux:heading>
                    <flux:text class="mt-2">
                        <p>Anda yakin ingin menghapus paket harga ini?</p>
                        <p>Tindakan ini tidak dapat dikembalikan.</p>
                    </flux:text>
                </div>

                <div class="flex gap-2">
                    <flux:spacer />
                    <flux:modal.close>
                        <flux:button variant="ghost">Batal</flux:button>
                    </flux:modal.close>

                    <flux:button type="submit" variant="danger" wire:click="deletePackage">
                        Hapus
                    </flux:button>
                </div>
            </div>
        </flux:modal>
    </div>
</div>
