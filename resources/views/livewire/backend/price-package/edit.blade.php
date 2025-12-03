<div>
    <flux:modal name="edit-pricepackage" class="md:w-900">
        <div class="space-y-6">

            {{-- HEADER --}}
            <div>
                <flux:heading size="lg">Edit Paket Harga</flux:heading>
                <flux:text class="mt-2">Perbarui informasi paket harga kos.</flux:text>
            </div>

            {{-- GRID 2 KOLOM --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- KATEGORI --}}
                <div>
                    <flux:select
                        label="Kategori"
                        wire:model="category_id"
                        placeholder="Pilih kategori">

                        <option value="">— Pilih Kategori —</option>

                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </flux:select>

                    @error('category_id')
                        <flux:text class="text-red-500 text-sm mt-1">{{ $message }}</flux:text>
                    @enderror
                </div>

                {{-- HARGA --}}
                <div>
                    <flux:input
                        label="Harga / Bulan"
                        type="number"
                        wire:model="price_per_month"
                        placeholder="Masukkan harga paket" />

                    @error('price_per_month')
                        <flux:text class="text-red-500 text-sm mt-1">{{ $message }}</flux:text>
                    @enderror
                </div>

                {{-- STATUS POPULER --}}
                <div>
                    <flux:select
                        label="Status Popularitas"
                        wire:model="is_popular">
                        <option value="0">Tidak Populer</option>
                        <option value="1">Paling Populer</option>
                    </flux:select>

                    @error('is_popular')
                        <flux:text class="text-red-500 text-sm mt-1">{{ $message }}</flux:text>
                    @enderror
                </div>

            </div> {{-- end grid --}}

            {{-- FASILITAS --}}
            <div>
                <flux:textarea
                    label="Fasilitas"
                    wire:model="facilities_text"
                    placeholder="Satu fasilitas per baris. Contoh:
Kasur & Lemari
Kamar mandi luar
WiFi 50 Mbps" />

                @error('facilities_text')
                    <flux:text class="text-red-500 text-sm mt-1">{{ $message }}</flux:text>
                @enderror
            </div>

            {{-- ACTION BUTTON --}}
            <div class="flex">
                <flux:spacer />

                <flux:button
                    type="submit"
                    variant="primary"
                    wire:click="update">
                    Simpan Perubahan
                </flux:button>
            </div>

        </div>
    </flux:modal>
</div>
