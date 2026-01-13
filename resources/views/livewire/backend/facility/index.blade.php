<div class="relative mb-6 w-full">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <flux:heading size="xl" level="1">{{ __('Fasilitas Kos') }}</flux:heading>
            <flux:subheading size="lg">{{ __('Kelola data fasilitas kos') }}</flux:subheading>
        </div>

        <div class="flex justify-start md:justify-end">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('dashboard') }}" separator="slash">Home</flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="#" separator="slash">Master Data</flux:breadcrumbs.item>
                <flux:breadcrumbs.item separator="slash">Facility</flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>
    </div>

    <flux:separator variant="subtle" />

    {{-- Tombol Create --}}
    <flux:modal.trigger name="create-facility">
        <flux:button class="mt-3">Tambah Fasilitas</flux:button>
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
    <livewire:backend.facility.create />
    <livewire:backend.facility.edit />

    {{-- Tabel Facility --}}
    <div class="mt-8 overflow-x-auto">
        <div class="overflow-x-auto rounded-xl shadow-md border border-gray-200 dark:border-neutral-700">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 rounded-lg shadow-md overflow-hidden">
                <thead class="bg-gray-50 dark:bg-neutral-900 text-gray-700 dark:text-gray-100 text-sm uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Nama Fasilitas</th>
                        <th class="px-6 py-3 text-left">Icon</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="bg-white dark:bg-neutral-950 divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse ($facilities as $index => $facility)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">
                                {{ $facilities->firstItem() + $index }}
                            </td>

                            <td class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-gray-100">
                                {{ $facility->name }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">
                                @if ($facility->icon)
                                    <div class="w-6 h-6">
                                        {!! $facility->icon !!}
                                    </div>
                                @else
                                    <span class="text-gray-400 italic">Tidak ada icon</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center space-x-2">
                                {{-- Edit --}}
                                <button wire:click="edit({{ $facility->id }})"
                                    title="Edit"
                                    class="text-green-500 hover:text-green-700 transition">
                                    <flux:icon.pencil-square variant="mini" class="size-5" />
                                </button>

                                {{-- Hapus --}}
                                <button wire:click="delete({{ $facility->id }})"
                                    title="Hapus"
                                    class="text-red-500 hover:text-red-700 transition">
                                    <flux:icon.trash variant="mini" class="size-5" />
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                Belum ada data fasilitas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $facilities->links() }}
        </div>

        {{-- MODAL DELETE --}}
        <flux:modal name="delete-facility" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Hapus Fasilitas?</flux:heading>
                    <flux:text class="mt-2">
                        <p>Anda yakin ingin menghapus data fasilitas ini?</p>
                        <p>Tindakan ini tidak dapat dikembalikan.</p>
                    </flux:text>
                </div>

                <div class="flex gap-2">
                    <flux:spacer />
                    <flux:modal.close>
                        <flux:button variant="ghost">Batal</flux:button>
                    </flux:modal.close>

                    <flux:button type="submit" variant="danger" wire:click="deleteFacility">
                        Hapus
                    </flux:button>
                </div>
            </div>
        </flux:modal>
    </div>
</div>
