<div>
    <flux:modal name="create-web-setting" class="md:w-900">
        <div class="space-y-6">

            <div>
                <flux:heading size="lg">Tambah Web Setting</flux:heading>
                <flux:text class="mt-2">
                    Silakan isi pengaturan utama website.
                </flux:text>
            </div>

            {{-- Judul Website --}}
            <flux:input
                label="Judul Website"
                wire:model.defer="site_title"
                placeholder="Contoh: Kos Harmoni Yogyakarta" />

            {{-- Deskripsi Website --}}
            <flux:textarea
                label="Deskripsi Website"
                wire:model.defer="site_description"
                rows="3"
                placeholder="Deskripsi singkat untuk SEO dan halaman utama" />

            {{-- Social Media (JSON sederhana) --}}
            <flux:textarea
                label="Media Sosial (JSON)"
                wire:model.defer="social_media"
                rows="4"
                placeholder='{"instagram":"https://instagram.com/xxx","whatsapp":"https://wa.me/628xxx"}' />

            <flux:text size="sm" class="text-gray-500">
                Format JSON. Contoh: instagram, facebook, whatsapp, dll.
            </flux:text>

            {{-- Copyright --}}
            <flux:input
                label="Copyright"
                wire:model.defer="copyright"
                placeholder="© 2025 Kos Harmoni. All rights reserved." />

            {{-- Status Aktif --}}
            <flux:checkbox
                wire:model.defer="is_active"
                label="Aktifkan sebagai setting utama website" />

            <div class="flex pt-4">
                <flux:spacer />

                <flux:button
                    type="submit"
                    variant="primary"
                    wire:click="save">
                    Simpan Web Setting
                </flux:button>
            </div>

        </div>
    </flux:modal>
</div>
