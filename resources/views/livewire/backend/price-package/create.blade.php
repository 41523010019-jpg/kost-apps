<div>
    <flux:modal name="create-pricepackage" class="md:w-900">
        <div class="space-y-6">

            {{-- Header --}}
            <div>
                <flux:heading size="lg">Tambah Paket Harga</flux:heading>
                <flux:text class="mt-2">Silakan isi informasi paket harga kos.</flux:text>
            </div>

            {{-- FORM GRID 2 KOLOM --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Kategori --}}
                <div>
                    <flux:select
                        label="Kategori"
                        wire:model="category_id"
                        placeholder="Pilih kategori paket">

                        <option value="">— Pilih Kategori —</option>

                        @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </flux:select>

                    @error('category_id')
                    <flux:text class="text-red-500 text-sm mt-1">{{ $message }}</flux:text>
                    @enderror
                </div>

                {{-- Harga Per Bulan --}}
                <div>
                    <flux:input
                        label="Harga / Bulan"
                        type="number"
                        wire:model="price_per_month"
                        placeholder="Masukkan harga per bulan" />

                    @error('price_per_month')
                    <flux:text class="text-red-500 text-sm mt-1">{{ $message }}</flux:text>
                    @enderror
                </div>

                {{-- Apakah Populer --}}
                <div>
                    <flux:select
                        label="Paket Populer?"
                        wire:model="is_popular">

                        <option value="0">Tidak</option>
                        <option value="1">Ya, Jadikan Populer</option>
                    </flux:select>

                    @error('is_popular')
                    <flux:text class="text-red-500 text-sm mt-1">{{ $message }}</flux:text>
                    @enderror
                </div>

            </div> {{-- end grid --}}

            {{-- Fasilitas --}}
            <div>
                <flux:textarea
                    label="Fasilitas (pisahkan dengan baris baru)"
                    wire:model="facilities_text"
                    placeholder="Contoh:
Kasur premium
WiFi cepat 50 Mbps
Kebersihan mingguan
Kamar mandi dalam" />


                @error('facilities')
                <flux:text class="text-red-500 text-sm mt-1">{{ $message }}</flux:text>
                @enderror
            </div>

            {{-- Action --}}
            <div class="flex">
                <flux:spacer />

                <flux:button
                    type="submit"
                    variant="primary"
                    wire:click="save">
                    Simpan Paket
                </flux:button>
            </div>

        </div>
    </flux:modal>
</div>