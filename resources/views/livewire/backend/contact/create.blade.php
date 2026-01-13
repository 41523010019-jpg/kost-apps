<div>
    <flux:modal name="create-contact" class="md:w-900">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Tambah Kontak</flux:heading>
                <flux:text class="mt-2">
                    Silakan isi informasi kontak kos.
                </flux:text>
            </div>

            {{-- Judul --}}
            <flux:input
                label="Judul (Opsional)"
                wire:model.defer="title"
                placeholder="Contoh: Hubungi Kami" />

            {{-- Deskripsi --}}
            <flux:textarea
                label="Deskripsi (Opsional)"
                wire:model.defer="description"
                rows="3"
                placeholder="Deskripsi singkat kontak kos..." />

            {{-- Alamat --}}
            <flux:textarea
                label="Alamat"
                wire:model.defer="address"
                rows="3"
                placeholder="Contoh: Jl. Harmoni No. 21, Kota Yogyakarta" />

            {{-- Catatan Alamat --}}
            <flux:input
                label="Catatan Alamat (Opsional)"
                wire:model.defer="address_note"
                placeholder="Contoh: Dekat kampus, minimarket, halte bus" />

            {{-- Nomor Telepon --}}
            <flux:input
                label="No. Telepon / WhatsApp"
                wire:model.defer="phone"
                placeholder="Contoh: 0812-3456-7890" />

            {{-- Catatan Telepon --}}
            <flux:input
                label="Catatan Telepon (Opsional)"
                wire:model.defer="phone_note"
                placeholder="Contoh: Fast response via WhatsApp" />

            {{-- Email --}}
            <flux:input
                type="email"
                label="Email"
                wire:model.defer="email"
                placeholder="Contoh: kosharmoni@gmail.com" />

            {{-- Google Maps Embed --}}
            <flux:textarea
                label="Google Maps Embed (iframe)"
                wire:model.defer="map_embed"
                rows="4"
                placeholder='<iframe src="https://www.google.com/maps/embed?..."></iframe>' />

            {{-- Status Aktif --}}
            <flux:checkbox
                wire:model.defer="is_active"
                label="Aktifkan sebagai kontak utama" />

            <div class="flex pt-4">
                <flux:spacer />

                <flux:button
                    type="submit"
                    variant="primary"
                    wire:click="save">
                    Simpan Kontak
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
