<div>
    <flux:modal name="create-room" class="md:w-900">
        <div class="space-y-6">

            {{-- Header --}}
            <div>
                <flux:heading size="lg">Tambah Kamar</flux:heading>
                <flux:text class="mt-2">Silakan isi detail informasi kamar baru.</flux:text>
            </div>

            {{-- FORM GRID 2 KOLOM --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Kategori --}}
                <div>
                    <flux:select
                        label="Kategori"
                        wire:model="category_id"
                        placeholder="Pilih kategori kamar">

                        <!-- Opsi default / informatif -->
                        <option value="">— Pilih Kategori —</option>

                        @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </flux:select>

                    @error('category_id')
                    <flux:text class="text-red-500 text-sm mt-1">{{ $message }}</flux:text>
                    @enderror
                </div>


                {{-- Nama Kamar --}}
                <div>
                    <flux:input
                        label="Nama Kamar"
                        wire:model="name"
                        placeholder="Masukkan nama kamar" />
                    @error('name')
                    <flux:text class="text-red-500 text-sm mt-1">{{ $message }}</flux:text>
                    @enderror
                </div>

                {{-- Harga --}}
                <div>
                    <flux:input
                        label="Harga / Bulan"
                        type="number"
                        wire:model="price"
                        placeholder="Masukkan harga kamar" />
                    @error('price')
                    <flux:text class="text-red-500 text-sm mt-1">{{ $message }}</flux:text>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <flux:select
                        label="Status Kamar"
                        wire:model="is_available">
                        <option value="1">Tersedia</option>
                        <option value="0">Penuh</option>
                    </flux:select>
                    @error('is_available')
                    <flux:text class="text-red-500 text-sm mt-1">{{ $message }}</flux:text>
                    @enderror
                </div>

            </div> {{-- end grid 2 kolom --}}

            {{-- Deskripsi Full Width --}}
            <div>
                <flux:textarea
                    label="Deskripsi"
                    wire:model="description"
                    placeholder="Tambahkan deskripsi atau fasilitas kamar" />
                @error('description')
                <flux:text class="text-red-500 text-sm mt-1">{{ $message }}</flux:text>
                @enderror
            </div>

            {{-- Upload Foto Full Width --}}
            <div>
                <flux:input
                    type="file"
                    multiple
                    wire:model="photos"
                    label="Foto Kamar" />

                @error('photos.*')
                <flux:text class="text-red-500 text-sm mt-1">{{ $message }}</flux:text>
                @enderror
            </div>

            {{-- Preview Foto --}}
            @if ($photos)
            <div class="flex gap-2 mt-2 flex-wrap">
                @foreach ($photos as $photo)
                <img src="{{ $photo->temporaryUrl() }}" class="w-24 h-24 rounded object-cover shadow-sm" />
                @endforeach
            </div>
            @endif


            {{-- Action --}}
            <div class="flex">
                <flux:spacer />

                <flux:button
                    type="submit"
                    variant="primary"
                    wire:click="save">
                    Simpan Kamar
                </flux:button>
            </div>

        </div>
    </flux:modal>
</div>