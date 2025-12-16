<div>
    <flux:modal name="edit-about" class="md:w-900">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit About</flux:heading>
                <flux:text class="mt-2">
                    Perbarui informasi tentang kos.
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
                placeholder="Perbarui deskripsi tentang kos..." />

            <div class="flex">
                <flux:spacer />
                <flux:button
                    type="submit"
                    variant="primary"
                    wire:click="update">
                    Update About
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
