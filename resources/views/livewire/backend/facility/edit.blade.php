<div>
    <flux:modal name="edit-facility" class="md:w-900">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Fasilitas</flux:heading>
                <flux:text class="mt-2">
                    Perbarui data fasilitas kos.
                </flux:text>
            </div>

            <!-- Nama Fasilitas -->
            <flux:input
                label="Nama Fasilitas"
                wire:model="name"
                placeholder="Contoh: WiFi Cepat" />

            <!-- Icon -->
            <flux:textarea
                label="Icon (SVG)"
                wire:model="icon"
                rows="5"
                placeholder="<svg xmlns='http://www.w3.org/2000/svg' ...>...</svg>" />

            <div class="flex">
                <flux:spacer />
                <flux:button
                    type="submit"
                    variant="primary"
                    wire:click="update">
                    Update Fasilitas
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
