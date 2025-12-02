<div>
    <flux:modal name="edit-room" class="md:w-900">
        <div class="space-y-6">

            {{-- HEADER --}}
            <div>
                <flux:heading size="lg">Edit Room</flux:heading>
                <flux:text class="mt-2">Perbarui informasi kamar kos.</flux:text>
            </div>

            {{-- GRID 2 KOLOM --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nama --}}
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
                        label="Harga"
                        type="number"
                        wire:model="price"
                        placeholder="Masukkan harga kamar" />
                    @error('price')
                        <flux:text class="text-red-500 text-sm mt-1">{{ $message }}</flux:text>
                    @enderror
                </div>

                {{-- Category ID --}}
                {{-- Kategori --}}
<div>
    <flux:select
        label="Kategori"
        wire:model="category_id"
        placeholder="Pilih kategori kamar">
        @foreach ($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </flux:select>
    @error('category_id')
        <flux:text class="text-red-500 text-sm mt-1">{{ $message }}</flux:text>
    @enderror
</div>


                {{-- Status --}}
                <div>
                    <flux:select
                        wire:model="is_available"
                        label="Status Ketersediaan">
                        <option value="1">Tersedia</option>
                        <option value="0">Tidak Tersedia</option>
                    </flux:select>
                    @error('is_available')
                        <flux:text class="text-red-500 text-sm mt-1">{{ $message }}</flux:text>
                    @enderror
                </div>

            </div> {{-- end grid --}}

            {{-- Deskripsi --}}
            <div>
                <flux:textarea
                    label="Deskripsi"
                    wire:model="description"
                    placeholder="Deskripsi kamar" />
                @error('description')
                    <flux:text class="text-red-500 text-sm mt-1">{{ $message }}</flux:text>
                @enderror
            </div>

            {{-- Upload Foto Baru --}}
            <div>
                <flux:input
                    type="file"
                    multiple
                    wire:model="newPhotos"
                    label="Foto Baru" />

                @error('newPhotos.*')
                    <flux:text class="text-red-500 text-sm">{{ $message }}</flux:text>
                @enderror
            </div>

            {{-- Preview Foto Baru --}}
            @if ($newPhotos)
                <div class="flex gap-2 mt-2 flex-wrap">
                    @foreach ($newPhotos as $photo)
                        <img src="{{ $photo->temporaryUrl() }}"
                             class="w-24 h-24 rounded object-cover shadow-sm" />
                    @endforeach
                </div>
            @endif

            {{-- Foto Lama --}}
            <div class="space-y-2">
                <h3 class="font-semibold">Foto Lama:</h3>

                <div class="flex gap-3 flex-wrap">
                    @foreach ($existingPhotos as $photo)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $photo) }}"
                                 class="w-24 h-24 rounded object-cover shadow" />

                            <button
                                class="absolute top-1 right-1 bg-red-600 p-1 rounded text-white text-xs"
                                wire:click="deletePhoto('{{ $photo }}')">
                                Hapus
                            </button>
                        </div>
                    @endforeach
                </div>
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
