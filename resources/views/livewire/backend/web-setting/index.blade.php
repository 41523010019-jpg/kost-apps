<div class="relative mb-6 w-full">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <flux:heading size="xl" level="1">
                {{ __('Pengaturan Website') }}
            </flux:heading>
            <flux:subheading size="lg">
                {{ __('Kelola pengaturan umum website') }}
            </flux:subheading>
        </div>

        <div class="flex justify-start md:justify-end">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item
                    href="{{ route('dashboard') }}"
                    separator="slash">
                    Home
                </flux:breadcrumbs.item>
                <flux:breadcrumbs.item separator="slash">
                    Master Data
                </flux:breadcrumbs.item>
                <flux:breadcrumbs.item separator="slash">
                    Web Setting
                </flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>
    </div>

    <flux:separator variant="subtle" />

    {{-- Tombol Create (hanya jika belum ada data) --}}
    @if ($settings->total() === 0)
        <flux:modal.trigger name="create-web-setting">
            <flux:button class="mt-3">
                Tambah Web Setting
            </flux:button>
        </flux:modal.trigger>
    @endif

    {{-- Alert Success --}}
    @if (session()->has('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 3000)"
            class="fixed top-5 right-5 bg-green-600 text-white text-sm p-4 rounded-lg shadow-lg z-50"
            role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- Modal create & edit --}}
    <livewire:backend.web-setting.create />
    <livewire:backend.web-setting.edit />

    <!-- Tabel Web Setting -->
    <div class="mt-8 overflow-x-auto">
        <div class="rounded-xl shadow-md border border-gray-200 dark:border-neutral-700">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-neutral-900 text-gray-700 dark:text-gray-100 text-sm uppercase">
                    <tr>
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Judul Website</th>
                        <th class="px-6 py-3 text-left">Deskripsi</th>
                        <th class="px-6 py-3 text-center">Status</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="bg-white dark:bg-neutral-950 divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse ($settings as $index => $setting)
                        <tr>
                            <td class="px-6 py-4 text-sm">
                                {{ $settings->firstItem() + $index }}
                            </td>

                            <td class="px-6 py-4 text-sm font-semibold">
                                {{ $setting->site_title }}
                            </td>

                            <td class="px-6 py-4 text-sm">
                                {{ Str::limit($setting->site_description, 80) }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if ($setting->is_active)
                                    <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                                        Aktif
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-600">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center space-x-2">
                                {{-- Edit --}}
                                <button
                                    wire:click="edit({{ $setting->id }})"
                                    title="Edit"
                                    class="text-green-500 hover:text-green-700 transition">
                                    <flux:icon.pencil-square variant="mini" class="size-5" />
                                </button>

                                {{-- Hapus --}}
                                <button
                                    wire:click="delete({{ $setting->id }})"
                                    title="Hapus"
                                    class="text-red-500 hover:text-red-700 transition">
                                    <flux:icon.trash variant="mini" class="size-5" />
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                Belum ada data Web Setting.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $settings->links() }}
        </div>

        {{-- MODAL DELETE --}}
        <flux:modal name="delete-web-setting" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Hapus Web Setting?</flux:heading>
                    <flux:text class="mt-2">
                        <p>Anda yakin ingin menghapus pengaturan website ini?</p>
                        <p>Tindakan ini tidak dapat dikembalikan.</p>
                    </flux:text>
                </div>

                <div class="flex gap-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Batal</flux:button>
                    </flux:modal.close>

                    <flux:button
                        type="submit"
                        variant="danger"
                        wire:click="deleteWebSetting">
                        Hapus
                    </flux:button>
                </div>
            </div>
        </flux:modal>
    </div>
</div>
