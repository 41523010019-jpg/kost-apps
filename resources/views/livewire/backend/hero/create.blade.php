<div>
    <flux:modal name="create-hero" class="md:w-600">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Tambah Hero</flux:heading>
                <flux:text class="mt-2">Silakan upload gambar hero slider dan tentukan urutannya.</flux:text>
            </div>

            {{-- Upload gambar --}}
            <flux:input
                type="file"
                wire:model="image"
                label="Gambar Hero" />

            @if ($image)
                <div class="mt-2">
                    <img src="{{ $image->temporaryUrl() }}" class="w-40 h-40 rounded-lg object-cover" />
                </div>
            @endif

            {{-- Urutan --}}
            <flux:input
                label="Urutan"
                type="number"
                wire:model="order"
                placeholder="Masukkan urutan hero" />

            <div class="flex">
                <flux:spacer />
                <flux:button
                    type="submit"
                    variant="primary"
                    wire:click="save">
                    Simpan Hero
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
