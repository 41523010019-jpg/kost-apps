<div class="min-h-screen bg-gray-50 font-inter">
    <section class="mt-28 max-w-7xl mx-auto px-6 pb-20">

        <div class="grid grid-cols-1 md:grid-cols-12 gap-10">

            {{-- ======================= GRID KAMAR ======================= --}}
            <div class="md:col-span-9">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Semua Kamar</h2>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

                    @foreach ($rooms as $room)
                    <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">

                        {{-- FOTO --}}
                        <div class="relative h-48">
                            <img src="{{ $room->photos->first()->url ?? 'https://via.placeholder.com/300' }}"
                                class="w-full h-full object-cover">

                            <span class="absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-semibold
                                {{ $room->is_available ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $room->is_available ? 'Tersedia' : 'Penuh' }}
                            </span>
                        </div>

                        <div class="p-5">
                            <h4 class="font-semibold text-lg text-gray-800">{{ $room->name }}</h4>

                            <p class="text-indigo-600 font-bold text-xl mt-3">
                                Rp {{ number_format($room->price, 0, ',', '.') }}/bulan
                            </p>

                            <a wire:navigate href="{{ route('rooms.show', $room) }}">
                                <button
                                    class="mt-5 w-full py-3 rounded-xl font-semibold transition
                {{ !$room->is_available 
                    ? 'bg-gray-300 text-gray-600 cursor-not-allowed'
                    : 'bg-indigo-600 text-white hover:bg-indigo-700 cursor-pointer'
                }}"
                                    {{ !$room->is_available ? 'disabled' : '' }}>
                                    Lihat Detail
                                </button>
                            </a>
                        </div>

                    </div>
                    @endforeach

                </div>

                {{-- PAGINATION --}}
                <div class="mt-10">
                    {{ $rooms->links() }}
                </div>
            </div>




            {{-- ======================= SIDEBAR CATEGORY ======================= --}}
            <div class="md:col-span-3 sticky top-32 h-max">

                <h3 class="text-xl font-bold text-gray-800 mb-4">Kategori Kamar</h3>

                <div class="space-y-4">

                    @foreach ($categories as $cat)
                    <button wire:click="$set('selectedCategory', '{{ $cat->slug }}')"
                        class="w-full p-4 bg-white rounded-xl shadow hover:bg-indigo-50 text-left transition cursor-pointer
                @if($selectedCategory === $cat->slug) border border-indigo-500 @endif">

                        <div class="flex items-center justify-between">
                            <span class="font-medium text-gray-700">{{ $cat->name }}</span>
                            <span class="text-sm text-gray-500">{{ $cat->rooms_count }} kamar</span>
                        </div>

                    </button>
                    @endforeach

                    <button wire:click="resetFilter"
                        class="mt-3 w-full py-2 text-indigo-600 font-semibold hover:text-indigo-800 cursor-pointer">
                        Reset Filter
                    </button>

                </div>

            </div>


        </div>

    </section>

</div>