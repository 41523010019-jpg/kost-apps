<div>
    <flux:modal name="edit-contact" class="md:w-900">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Kontak</flux:heading>
                <flux:text class="mt-2">
                    Perbarui informasi kontak kos.
                </flux:text>
            </div>

            <!-- Judul -->
            <flux:input
                label="Judul"
                wire:model.defer="title"
                placeholder="Contoh: Hubungi Kami" />

            <!-- Deskripsi -->
            <flux:textarea
                label="Deskripsi"
                wire:model.defer="description"
                rows="4"
                placeholder="Deskripsi singkat kontak kos..." />

            <!-- Alamat -->
            <flux:textarea
                label="Alamat"
                wire:model.defer="address"
                rows="3"
                placeholder="Jl. Harmoni No. 21, Kota Yogyakarta" />

            <!-- Catatan Alamat -->
            <flux:input
                label="Catatan Alamat"
                wire:model.defer="address_note"
                placeholder="Dekat kampus, minimarket, halte bus" />

            <!-- Telepon -->
            <flux:input
                label="Nomor Telepon"
                wire:model.defer="phone"
                placeholder="0812xxxxxxx" />

            <!-- Catatan Telepon -->
            <flux:input
                label="Catatan Telepon"
                wire:model.defer="phone_note"
                placeholder="Fast response via WhatsApp" />

            <!-- Email -->
            <flux:input
                type="email"
                label="Email"
                wire:model.defer="email"
                placeholder="kosharmoni@gmail.com" />

            <!-- Google Maps Embed -->
            <flux:textarea
                label="Google Maps Embed"
                wire:model.defer="map_embed"
                rows="3"
                placeholder="<iframe src='https://www.google.com/maps/...'></iframe>" />

            <!-- Status Aktif -->
            <flux:switch
                label="Aktifkan Kontak"
                wire:model="is_active" />

            <div class="flex">
                <flux:spacer />
                <flux:button
                    type="submit"
                    variant="primary"
                    wire:click="update">
                    Update Kontak
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
