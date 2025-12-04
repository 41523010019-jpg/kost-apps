<div>
    <flux:modal name="edit-hero" class="md:w-900">
        <form wire:submit.prevent="update">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Edit Hero</flux:heading>
                    <flux:text class="mt-2">Silakan ubah detail hero (gambar & urutan).</flux:text>
                </div>

                {{-- Urutan --}}
                <flux:input
                    type="number"
                    label="Urutan"
                    wire:model.defer="order"
                    placeholder="Masukkan urutan hero" />

                {{-- Upload Gambar Baru --}}
                <flux:input
                    type="file"
                    wire:model="newImage"
                    label="Gambar Hero Baru" />

                {{-- Preview Gambar Baru --}}
                @if ($newImage)
                <div class="grid grid-cols-3 gap-3 mt-2">
                    <img src="{{ $newImage->temporaryUrl() }}" class="w-32 h-32 rounded object-cover" alt="preview">
                </div>
                @endif

                {{-- Gambar Saat Ini --}}
                @if ($existingImage)
                <div class="mt-4">
                    <span class="text-sm text-gray-300">Gambar Saat Ini:</span>
                    <div class="relative mt-2 w-32 h-32">
                        <img src="{{ asset('storage/' . $existingImage) }}"
                            class="w-32 h-32 rounded object-cover" alt="existing">

                        {{-- Tombol Hapus --}}
                        <button type="button"
                            wire:click="deleteImage"
                            class="absolute top-0 right-0 bg-red-500 text-white text-xs px-1 rounded-full">
                            ✕
                        </button>
                    </div>
                </div>
                @endif

                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary">Simpan Perubahan</flux:button>
                </div>
            </div>
        </form>
    </flux:modal>
</div>