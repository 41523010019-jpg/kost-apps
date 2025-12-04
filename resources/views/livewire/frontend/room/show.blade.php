<div class="min-h-screen bg-gray-50 font-inter"
    x-data="{ loginModal:false, bookingModal:false }">

    <!-- DETAIL KAMAR -->
    <section class="mt-24 max-w-7xl mx-auto px-6 py-12">
        <div class="grid md:grid-cols-2 gap-12">

            <!-- GALERI GAMBAR -->
            <div x-data="{ current: 0, images: @js($room->photos->pluck('url')) }" class="relative">

                <!-- BADGE STATUS (KIRI ATAS) -->
                <span
                    class="absolute top-4 left-4 px-4 py-1.5 text-sm font-semibold rounded-full shadow
                    {{ $room->is_available ? 'bg-green-600 text-white' : 'bg-red-600 text-white' }}">
                    {{ $room->is_available ? 'Tersedia' : 'Tidak Tersedia' }}
                </span>

                <!-- BADGE CATEGORY (KANAN ATAS) -->
                <span
                    class="absolute top-4 right-4 px-4 py-1.5 text-sm font-semibold rounded-full shadow bg-indigo-600 text-white">
                    {{ $room->category->name }}
                </span>

                <!-- GAMBAR UTAMA -->
                <div class="rounded-3xl overflow-hidden shadow-xl">
                    <img :src="images[current]" class="w-full h-96 object-cover rounded-3xl">
                </div>

                <!-- TOMBOL NEXT / PREV -->
                <button
                    @click="current = (current === 0) ? images.length - 1 : current - 1"
                    class="absolute left-3 top-1/2 -translate-y-1/2 bg-white/70 backdrop-blur p-3 rounded-full shadow hover:bg-white">
                    ‹
                </button>

                <button
                    @click="current = (current === images.length - 1) ? 0 : current + 1"
                    class="absolute right-3 top-1/2 -translate-y-1/2 bg-white/70 backdrop-blur p-3 rounded-full shadow hover:bg-white">
                    ›
                </button>

                <!-- THUMBNAIL -->
                <div class="flex flex-wrap gap-3 mt-4">
                    <template x-for="(img, index) in images" :key="index">
                        <img
                            :src="img"
                            @click="current = index"
                            class="w-20 h-16 object-cover rounded-lg border cursor-pointer"
                            :class="current === index ? 'ring-2 ring-indigo-600' : ''">
                    </template>
                </div>
            </div>

            <!-- INFO KAMAR -->
            <div class="flex flex-col justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">{{ $room->name }}</h2>

                    <p class="text-indigo-600 font-bold text-2xl mt-3">
                        Rp {{ number_format($room->price, 0, ',', '.') }}/bulan
                    </p>

                    <p class="text-gray-600 mt-4">{!! nl2br(e($room->description)) !!}</p>

                    <!-- FASILITAS -->
                    @if ($package && $package->facilities)
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        @foreach ($package->facilities as $item)
                        <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-xl shadow">
                            <span class="text-indigo-600 text-lg">✔</span>
                            <span class="font-medium text-gray-700">{{ $item }}</span>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-gray-500 mt-4">Fasilitas belum tersedia.</p>
                    @endif
                </div>

                <!-- TOMBOL BOOKING -->
                <button
                    @if(!$room->is_available) disabled @endif

                    @click="
                    @guest
                    loginModal = true
                    @else
                    bookingModal = true
                    @endguest
                    "

                    class="mt-8 w-full py-3 rounded-xl font-semibold
                    {{ $room->is_available
                            ? 'bg-indigo-600 hover:bg-indigo-700 text-white cursor-pointer'
                            : 'bg-gray-400 text-white cursor-not-allowed' }}"
                    >
                    {{ $room->is_available ? 'Booking Sekarang' : 'Tidak Tersedia' }}
                </button>
            </div>

        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex items-center justify-between mb-10">
                <h3 class="text-3xl font-bold text-gray-800">Kamar Terkait</h3>

                <a wire:navigate href="{{ route('rooms.index') }}"
                    class="text-indigo-600 font-semibold">
                    Lihat Semua Kamar →
                </a>
            </div>

            <div class="grid md:grid-cols-3 gap-8">

                @foreach ($relatedRooms as $r)
                <div class="bg-white rounded-2xl shadow overflow-hidden">

                    <img src="{{ $r->photos->first()->url ?? 'https://via.placeholder.com/300x200' }}"
                        class="w-full h-52 object-cover">

                    <div class="p-5">
                        <h4 class="font-semibold text-lg text-gray-800">
                            {{ $r->name }}
                        </h4>

                        <p class="text-indigo-600 font-bold text-xl mt-3">
                            Rp {{ number_format($r->price, 0, ',', '.') }}/bulan
                        </p>

                        <a
                            href="{{ route('rooms.show', $r->id) }}"
                            wire:navigate
                            class="mt-5 block w-full py-3 rounded-xl bg-indigo-600 text-white text-center">
                            Lihat Detail
                        </a>

                    </div>

                </div>
                @endforeach

            </div>

        </div>
    </section>
    <!-- MODAL LOGIN -->
    <div x-show="loginModal"
        x-transition
        @click.self="loginModal = false"
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

        <div class="bg-white p-8 rounded-2xl shadow-xl w-96">
            <h2 class="text-2xl font-semibold text-gray-800">Login Diperlukan</h2>
            <p class="text-gray-600 mt-2">Anda harus login untuk melakukan booking.</p>

            <a href="{{ route('login') }}"
                class="mt-6 block w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-center rounded-xl">
                Login Sekarang
            </a>

            <button @click="loginModal = false"
                class="mt-3 w-full py-2 bg-gray-200 hover:bg-gray-300 rounded-xl text-gray-700">
                Tutup
            </button>
        </div>
    </div>


    <!-- MODAL BOOKING -->
    <!-- MODAL BOOKING -->
    <div x-show="bookingModal"
        x-transition
        @click.self="bookingModal = false"
        wire:ignore.self
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

        <div class="bg-white p-8 rounded-2xl shadow-xl w-96">
            <h2 class="text-xl font-bold text-gray-800">Konfirmasi Booking</h2>

            <p class="mt-2 text-gray-600">
                <strong>{{ $room->name }}</strong> <br>
                Harga: Rp {{ number_format($room->price, 0, ',', '.') }}/bulan
            </p>

            <div class="mt-4">
                <label class="font-medium text-gray-700">Mulai tanggal</label>
                <input type="date"
                    wire:model="start_date"
                    class="mt-1 w-full border-gray-300 rounded-xl">
            </div>

            <button
                wire:click="createBooking({{ $room->id }})"
                wire:loading.attr="disabled"
                wire:loading.class="opacity-50 cursor-not-allowed"
                class="mt-6 w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl">
                <span wire:loading.remove>Konfirmasi Booking</span>
                <span wire:loading>Membuat booking...</span>
            </button>

            <button @click="bookingModal = false"
                class="mt-3 w-full py-2 bg-gray-200 hover:bg-gray-300 rounded-xl text-gray-700">
                Batal
            </button>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script>
        Livewire.on('open-snap', data => {
            snap.pay(data.snapToken, {
                onSuccess: function(result) {
                    window.location.href = "/payment/success";
                },
                onPending: function(result) {
                    console.log("pending");
                },
                onError: function(result) {
                    alert("Pembayaran gagal");
                },
                onClose: function() {
                    alert("Anda menutup popup tanpa menyelesaikan pembayaran");
                }
            });
        });
    </script>

</div>