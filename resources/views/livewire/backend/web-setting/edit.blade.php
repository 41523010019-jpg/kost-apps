<div>
    <flux:modal name="edit-web-setting" class="md:w-900">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Web Setting</flux:heading>
                <flux:text class="mt-2">
                    Perbarui pengaturan utama website.
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
                rows="4"
                placeholder="Deskripsi singkat website / kos..." />

            {{-- Social Media --}}
            <div class="space-y-3">
                <flux:heading size="sm">Media Sosial</flux:heading>

                <flux:input
                    label="Instagram"
                    wire:model.defer="social_media.instagram"
                    placeholder="https://instagram.com/username" />

                <flux:input
                    label="Facebook"
                    wire:model.defer="social_media.facebook"
                    placeholder="https://facebook.com/username" />

                <flux:input
                    label="WhatsApp"
                    wire:model.defer="social_media.whatsapp"
                    placeholder="081234567890" />
            </div>

            {{-- Copyright --}}
            <flux:input
                label="Copyright"
                wire:model.defer="copyright"
                placeholder="© 2025 Kos Harmoni. All rights reserved." />

            {{-- Status Aktif --}}
            <flux:switch
                label="Aktifkan sebagai Web Setting utama"
                wire:model="is_active" />

            <div class="flex pt-4">
                <flux:spacer />

                <flux:button
                    type="submit"
                    variant="primary"
                    wire:click="update">
                    Update Web Setting
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
