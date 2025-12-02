<div>
    <flux:modal name="create-category" class="md:w-900">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Tambah Kategori</flux:heading>
                <flux:text class="mt-2">Silakan isi nama kategori baru.</flux:text>
            </div>

            <!-- Nama Kategori -->
            <flux:input
                label="Nama Kategori"
                wire:model="name"
                placeholder="Masukkan nama kategori" />

            <div class="flex">
                <flux:spacer />
                <flux:button
                    type="submit"
                    variant="primary"
                    wire:click="save">
                    Simpan Kategori
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
