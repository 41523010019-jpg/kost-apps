<div class="relative mb-6 w-full">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <flux:heading size="xl" level="1">{{ __('Kontak Kos') }}</flux:heading>
            <flux:subheading size="lg">
                {{ __('Kelola informasi kontak kos') }}
            </flux:subheading>
        </div>

        <div class="flex justify-start md:justify-end">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('dashboard') }}" separator="slash">
                    Home
                </flux:breadcrumbs.item>
                <flux:breadcrumbs.item separator="slash">
                    Master Data
                </flux:breadcrumbs.item>
                <flux:breadcrumbs.item separator="slash">
                    Contact
                </flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>
    </div>

    <flux:separator variant="subtle" />

    {{-- Tombol Create --}}
        @if ($contacts->total() === 0)
        <flux:modal.trigger name="create-contact">
            <flux:button class="mt-3">
                Tambah Contact
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
        <livewire:backend.contact.create />
        <livewire:backend.contact.edit />

        <!-- Tabel Contact -->
        <div class="mt-8 overflow-x-auto">
            <div class="rounded-xl shadow-md border border-gray-200 dark:border-neutral-700">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-neutral-900 text-gray-700 dark:text-gray-100 text-sm uppercase">
                        <tr>
                            <th class="px-6 py-3 text-left">#</th>
                            <th class="px-6 py-3 text-left">Alamat</th>
                            <th class="px-6 py-3 text-left">Telepon</th>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white dark:bg-neutral-950 divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse ($contacts as $index => $contact)
                        <tr>
                            <td class="px-6 py-4 text-sm">
                                {{ $contacts->firstItem() + $index }}
                            </td>

                            <td class="px-6 py-4 text-sm">
                                {{ Str::limit($contact->address, 60) }}
                            </td>

                            <td class="px-6 py-4 text-sm">
                                {{ $contact->phone }}
                            </td>

                            <td class="px-6 py-4 text-sm">
                                {{ $contact->email }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if ($contact->is_active)
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
                                    wire:click="edit({{ $contact->id }})"
                                    title="Edit"
                                    class="text-green-500 hover:text-green-700 transition">
                                    <flux:icon.pencil-square variant="mini" class="size-5" />
                                </button>

                                {{-- Hapus --}}
                                <button
                                    wire:click="delete({{ $contact->id }})"
                                    title="Hapus"
                                    class="text-red-500 hover:text-red-700 transition">
                                    <flux:icon.trash variant="mini" class="size-5" />
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Belum ada data Contact.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $contacts->links() }}
            </div>

            {{-- MODAL DELETE --}}
            <flux:modal name="delete-contact" class="min-w-[22rem]">
                <div class="space-y-6">
                    <div>
                        <flux:heading size="lg">Hapus Contact?</flux:heading>
                        <flux:text class="mt-2">
                            <p>Anda yakin ingin menghapus data kontak ini?</p>
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
                            wire:click="deleteContact">
                            Hapus
                        </flux:button>
                    </div>
                </div>
            </flux:modal>
        </div>
</div>