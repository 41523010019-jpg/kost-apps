<div>
    <flux:modal name="create-about" class="md:w-900">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Tambah About</flux:heading>
                <flux:text class="mt-2">
                    Silakan isi informasi tentang kos.
                </flux:text>
            </div>

            <!-- Judul -->
            <flux:input
                label="Judul"
                wire:model="title"
                placeholder="Contoh: Tentang Kos" />

            <!-- Deskripsi -->
            <flux:textarea
                label="Deskripsi"
                wire:model="description"
                rows="5"
                placeholder="Tuliskan deskripsi lengkap tentang kos..." />

            <div class="flex">
                <flux:spacer />
                <flux:button
                    type="submit"
                    variant="primary"
                    wire:click="save">
                    Simpan About
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
