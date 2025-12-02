<div>
    <flux:modal name="edit-category" class="md:w-900">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Kategori</flux:heading>
                <flux:text class="mt-2">Perbarui nama kategori.</flux:text>
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
                    wire:click="update">
                    Update Kategori
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
