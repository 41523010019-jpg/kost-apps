<div class="min-h-screen bg-gray-50 font-inter">

    <!-- NAVBAR -->
    <header x-data="{ open:false }" class="fixed w-full top-0 bg-white/80 backdrop-blur shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <h1 class="text-2xl font-bold text-indigo-600">Kos Harmoni</h1>

            <!-- DESKTOP NAV -->
            <nav class="hidden md:flex space-x-8 text-gray-700 font-medium">
                <a href="#" class="hover:text-indigo-600">Beranda</a>
                <a href="#kamar" class="hover:text-indigo-600">Kamar</a>
                <a href="#fasilitas" class="hover:text-indigo-600">Fasilitas</a>
                <a href="#kontak" class="hover:text-indigo-600">Kontak</a>
            </nav>

            <!-- MOBILE BUTTON -->
            <button @click="open = !open" class="md:hidden text-gray-700">
                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- MOBILE NAV -->
        <div x-show="open" x-transition class="md:hidden px-6 pb-4 bg-white border-t shadow">
            <a href="#" class="block py-2 text-gray-700">Beranda</a>
            <a href="#kamar" class="block py-2 text-gray-700">Kamar</a>
            <a href="#fasilitas" class="block py-2 text-gray-700">Fasilitas</a>
            <a href="#kontak" class="block py-2 text-gray-700">Kontak</a>
        </div>
    </header>

    <!-- HERO -->
    <!-- HERO MODERN -->
    <section
        x-data="{
        active: 0,
        slides: [
    { image: 'https://images.pexels.com/photos/271639/pexels-photo-271639.jpeg?auto=compress&cs=tinysrgb&w=1400' },

    { image: 'https://images.pexels.com/photos/271624/pexels-photo-271624.jpeg?auto=compress&cs=tinysrgb&w=1400' },

    { image: 'https://images.pexels.com/photos/259962/pexels-photo-259962.jpeg?auto=compress&cs=tinysrgb&w=1400' },
]
    ,
        next(){ this.active = (this.active + 1) % this.slides.length },
        prev(){ this.active = (this.active - 1 + this.slides.length) % this.slides.length },
        init(){ setInterval(() => this.next(), 4500) }
    }"
        class="mt-24 relative h-[460px] md:h-[600px] bg-white-100 pt-10 md:pt-16">

        <!-- WRAPPER AGAR SERAGAM dengan TEMPLATE -->
        <div class="absolute inset-0 max-w-7xl mx-auto">

            <!-- SLIDER CONTAINER -->
            <div class="relative h-full mx-6 rounded-3xl overflow-hidden shadow-xl">

                <!-- Slides -->
                <template x-for="(slide, i) in slides" :key="i">
                    <div
                        class="absolute inset-0 transition-transform duration-700 ease-out"
                        :style="`transform: translateX(${(i - active) * 100}%)`">

                        <img :src="slide.image" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-b from-black/30 to-black/70"></div>
                    </div>
                </template>

                <!-- TEXT CENTER -->
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6">
                    <h1 class="text-4xl md:text-6xl font-extrabold text-white drop-shadow-lg tracking-wide">
                        Kos Eksklusif & Nyaman
                    </h1>

                    <p class="mt-4 text-gray-200 text-lg md:text-xl max-w-2xl">
                        Hunian modern untuk mahasiswa & pekerja. Lokasi strategis, fasilitas lengkap, suasana nyaman.
                    </p>

                    <a href="#kamar"
                        class="mt-8 bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl font-semibold shadow-lg transition">
                        Lihat Kamar Tersedia
                    </a>
                </div>

                <!-- ARROW NAVIGATION -->
                <button
                    @click="prev"
                    class="hidden md:block absolute left-4 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/50 text-white p-3 rounded-full backdrop-blur-md shadow transition">
                    ‹
                </button>


                <button
                    @click="next"
                    class="hidden md:block absolute right-4 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/50 text-white p-3 rounded-full backdrop-blur-md shadow transition">
                    ›
                </button>


                <!-- DOTS -->
                <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2">
                    <template x-for="(slide, index) in slides" :key="index">
                        <div
                            @click="active = index"
                            class="w-3 h-3 rounded-full cursor-pointer transition"
                            :class="active === index ? 'bg-white' : 'bg-white/40'">
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </section>



    <!-- TENTANG KOS -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold text-gray-800">Tentang Kos</h3>
            <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
                Kos Harmoni menyediakan kamar bersih, fasilitas lengkap, dan suasana yang nyaman.
                Lokasi dekat kampus, minimarket, dan transportasi umum.
            </p>
        </div>
    </section>

    <!-- LIST KAMAR -->
    <section id="kamar" class="py-20">
        <div class="max-w-7xl mx-auto px-6">

            <!-- TITLE -->
            <div class="flex items-center justify-between mb-10">
                <h3 class="text-3xl font-bold text-gray-800">Kamar Tersedia</h3>

                <a href="/kamar"
                    class="text-indigo-600 hover:text-indigo-700 font-semibold text-sm md:text-base">
                    Lihat Semua Kamar →
                </a>
            </div>

            <!-- SLIDER -->
            <div
                x-data="{
                rooms: @js(
                    $rooms->map(fn($r) => [
                        'title' => $r->name,
                        'price' => number_format($r->price, 0, ',', '.'),
                        'status' => $r->is_available ? 'kosong' : 'penuh',
                        'img' => $r->photos->first()?->path 
                            ? asset('storage/' . $r->photos->first()->path)
                            : 'https://via.placeholder.com/400x300?text=No+Image',
                    ])
                ),

                autoSlide: null,

                start() {
                    this.autoSlide = setInterval(() => this.right(), 2500);
                },

                stop() {
                    clearInterval(this.autoSlide);
                },

                left() {
                    this.$refs.slider.scrollBy({ left: -330, behavior: 'smooth' });
                },

                right() {
                    this.$refs.slider.scrollBy({ left: 330, behavior: 'smooth' });

                    if (this.$refs.slider.scrollLeft + this.$refs.slider.clientWidth >=
                        this.$refs.slider.scrollWidth - 5)
                    {
                        this.$refs.slider.scrollTo({ left: 0, behavior: 'smooth' });
                    }
                }
            }"
                x-init="start()"
                class="relative">

                <!-- Fade Left -->
                <div class="absolute left-0 top-0 h-full w-24 bg-gradient-to-r from-gray-50 to-transparent pointer-events-none z-10"></div>

                <!-- Fade Right -->
                <div class="absolute right-0 top-0 h-full w-24 bg-gradient-to-l from-gray-50 to-transparent pointer-events-none z-10"></div>

                <!-- ARROW LEFT -->
                <button
                    @click="left"
                    class="hidden md:flex absolute left-4 top-1/2 -translate-y-1/2 z-20 bg-white shadow-md p-3 rounded-full hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <!-- ARROW RIGHT -->
                <button
                    @click="right"
                    class="hidden md:flex absolute right-4 top-1/2 -translate-y-1/2 z-20 bg-white shadow-md p-3 rounded-full hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <!-- SLIDER -->
                <div
                    x-ref="slider"
                    @mouseenter="stop"
                    @mouseleave="start"
                    class="flex space-x-6 overflow-x-auto pb-4 hide-scroll-bar scroll-smooth snap-x snap-mandatory">

                    <template x-for="room in rooms" :key="room.title">
                        <div class="min-w-[260px] md:min-w-[300px] snap-start bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">

                            <div class="relative">
                                <img :src="room.img" class="w-full h-52 object-cover">

                                <span class="absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-semibold"
                                    :class="room.status === 'kosong'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-red-100 text-red-700'">
                                    <span x-text="room.status === 'kosong' ? 'Tersedia' : 'Penuh'"></span>
                                </span>
                            </div>

                            <div class="p-5">
                                <h4 class="font-semibold text-lg text-gray-800" x-text="room.title"></h4>

                                <p class="text-indigo-600 font-bold text-xl mt-3">
                                    Rp <span x-text="room.price"></span>/bulan
                                </p>

                                <button
                                    :disabled="room.status === 'penuh'"
                                    class="mt-5 w-full py-3 rounded-xl font-semibold transition"
                                    :class="room.status === 'penuh'
                                    ? 'bg-gray-300 text-gray-600 cursor-not-allowed'
                                    : 'bg-indigo-600 text-white hover:bg-indigo-700'">
                                    Lihat Detail
                                </button>
                            </div>
                        </div>
                    </template>

                </div>
            </div>
        </div>
    </section>





    <!-- FASILITAS -->
    <section id="fasilitas" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <h3 class="text-3xl font-bold text-center text-gray-800 mb-12">Fasilitas Kos</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 text-center">

                <div class="p-8 bg-gray-50 rounded-2xl shadow hover:-translate-y-1 transition">
                    <!-- Globe Alt Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 21a9 9 0 100-18 9 9 0 000 18zM2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7M2.458 12c1.274 4.057 5.064 7 9.542 7 4.478 0 8.268-2.943 9.542-7M2.458 12H21.54" />
                    </svg>
                    <h4 class="font-semibold mt-2">WiFi Cepat</h4>
                </div>

                <div class="p-8 bg-gray-50 rounded-2xl shadow hover:-translate-y-1 transition">
                    <!-- Bed Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3 7v10m18 0V7M3 12h18M7 7h10a3 3 0 013 3v2H4v-2a3 3 0 013-3z" />
                    </svg>
                    <h4 class="font-semibold mt-2">Kasur & Lemari</h4>
                </div>

                <div class="p-8 bg-gray-50 rounded-2xl shadow hover:-translate-y-1 transition">
                    <!-- Shower Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 4l16 0M8 4v3a4 4 0 008 0V4" />
                        <path stroke-linecap="round" stroke-width="1.5" d="M8 14v.01M12 14v.01M16 14v.01" />
                    </svg>
                    <h4 class="font-semibold mt-2">Kamar Mandi Dalam</h4>
                </div>

                <div class="p-8 bg-gray-50 rounded-2xl shadow hover:-translate-y-1 transition">
                    <!-- Parking Icon (Using Square + P) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <rect x="3" y="3" width="18" height="18" rx="3" stroke-width="1.5" />
                        <path d="M10 16V8h3a2 2 0 010 4h-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <h4 class="font-semibold mt-2">Parkir Luas</h4>
                </div>

                <div class="p-8 bg-gray-50 rounded-2xl shadow hover:-translate-y-1 transition">
                    <!-- CCTV Icon (Video Camera) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14m0-4v4m0-4H5a2 2 0 00-2 2v0a2 2 0 002 2h10" />
                    </svg>
                    <h4 class="font-semibold mt-2">CCTV 24 Jam</h4>
                </div>

                <div class="p-8 bg-gray-50 rounded-2xl shadow hover:-translate-y-1 transition">
                    <!-- Door Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            d="M7 21V5a2 2 0 012-2h6a2 2 0 012 2v16M10 11h.01" />
                    </svg>
                    <h4 class="font-semibold mt-2">One Gate System</h4>
                </div>

                <div class="p-8 bg-gray-50 rounded-2xl shadow hover:-translate-y-1 transition">
                    <!-- Shield Check Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 3l7 4v5a9 9 0 11-14 0V7l7-4z" />
                    </svg>
                    <h4 class="font-semibold mt-2">Security 24 Jam</h4>
                </div>

            </div>
        </div>
    </section>


    <!-- PRICING -->
    <section id="paket" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold text-gray-800">Paket Harga Kos</h3>
            <p class="mt-3 text-gray-600 max-w-2xl mx-auto">
                Pilih paket sesuai kebutuhan Anda. Harga sudah termasuk fasilitas utama.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-14">

                <!-- BASIC -->
                <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200 hover:-translate-y-2 transition">
                    <h4 class="text-xl font-bold text-gray-800">Basic</h4>
                    <p class="text-gray-500 mt-1">Pilihan hemat untuk kebutuhan dasar</p>

                    <h3 class="text-4xl font-extrabold text-indigo-600 mt-6">
                        Rp 750.000
                        <span class="text-lg text-gray-500 font-medium">/bulan</span>
                    </h3>

                    <ul class="text-left space-y-3 mt-6 text-gray-600">
                        <li>• Kasur & Lemari</li>
                        <li>• Kamar mandi luar</li>
                        <li>• Akses WiFi normal</li>
                        <li>• Kebersihan mingguan</li>
                    </ul>

                    <button class="mt-8 w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold">
                        Pilih Basic
                    </button>
                </div>

                <!-- GOLD (HIGHLIGHT) -->
                <div class="bg-white shadow-2xl rounded-2xl p-8 border-2 border-indigo-600 scale-105 relative">

                    <span class="absolute -top-4 left-1/2 -translate-x-1/2 bg-indigo-600 text-white px-4 py-1 rounded-full text-sm font-semibold shadow">
                        Paling Populer
                    </span>

                    <h4 class="text-xl font-bold text-gray-800">Gold</h4>
                    <p class="text-gray-500 mt-1">Kamar nyaman dengan fasilitas lebih lengkap</p>

                    <h3 class="text-4xl font-extrabold text-indigo-600 mt-6">
                        Rp 950.000
                        <span class="text-lg text-gray-500 font-medium">/bulan</span>
                    </h3>

                    <ul class="text-left space-y-3 mt-6 text-gray-600">
                        <li>• Kasur premium & lemari besar</li>
                        <li>• Kamar mandi dalam</li>
                        <li>• WiFi cepat 50 Mbps</li>
                        <li>• Kebersihan 2x seminggu</li>
                        <li>• Meja belajar</li>
                    </ul>

                    <button class="mt-8 w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold">
                        Pilih Gold
                    </button>
                </div>

                <!-- PREMIUM -->
                <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200 hover:-translate-y-2 transition">
                    <h4 class="text-xl font-bold text-gray-800">Premium</h4>
                    <p class="text-gray-500 mt-1">Fasilitas terbaik untuk kenyamanan maksimal</p>

                    <h3 class="text-4xl font-extrabold text-indigo-600 mt-6">
                        Rp 1.250.000
                        <span class="text-lg text-gray-500 font-medium">/bulan</span>
                    </h3>

                    <ul class="text-left space-y-3 mt-6 text-gray-600">
                        <li>• Tempat tidur premium</li>
                        <li>• AC + kamar mandi dalam</li>
                        <li>• WiFi super cepat 100 Mbps</li>
                        <li>• Kebersihan harian</li>
                        <li>• Smart TV</li>
                    </ul>

                    <button class="mt-8 w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold">
                        Pilih Premium
                    </button>
                </div>

            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <!-- CONTACT -->
    <section id="kontak" class="py-20 bg-white border-t">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">

            <!-- TEXT -->
            <div>
                <h3 class="text-3xl font-bold text-gray-800">Hubungi Kami</h3>
                <p class="mt-4 text-gray-600">
                    Jika Anda memiliki pertanyaan, ingin melihat kamar, atau ingin booking,
                    silakan hubungi kami melalui kontak berikut.
                </p>

                <div class="mt-8 space-y-5 text-gray-700">

                    <div class="flex items-start space-x-4">
                        <div class="bg-indigo-600 text-white p-3 rounded-xl shadow">
                            📍
                        </div>
                        <p>
                            Jl. Harmoni No. 21, Kota Yogyakarta
                            Dekat kampus, minimarket, dan halte bus utama.
                        </p>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="bg-indigo-600 text-white p-3 rounded-xl shadow">
                            📞
                        </div>
                        <p>
                            0812-3456-7890
                            <span class="text-gray-500 text-sm">Fast response via WhatsApp</span>
                        </p>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="bg-indigo-600 text-white p-3 rounded-xl shadow">
                            ✉️
                        </div>
                        <p>kosharmoni@gmail.com</p>
                    </div>

                </div>
            </div>

            <!-- MAP -->
            <div class="w-full h-72 rounded-2xl overflow-hidden shadow-lg">
                <iframe
                    class="w-full h-full"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.3864183006904!2d110.3671!3d-7.9819"
                    allowfullscreen="" loading="lazy">
                </iframe>
            </div>

        </div>
    </section>



    <!-- FOOTER -->
    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-300 mt-20">
        <div class="max-w-7xl mx-auto px-6 py-14 grid md:grid-cols-4 gap-10">

            <div>
                <h2 class="text-2xl font-bold text-white">Kos Harmoni</h2>
                <p class="mt-4 text-gray-400">
                    Hunian nyaman dan modern untuk mahasiswa & pekerja.
                </p>
            </div>

            <div>
                <h4 class="font-semibold text-white mb-3">Navigasi</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-indigo-400">Beranda</a></li>
                    <li><a href="#kamar" class="hover:text-indigo-400">Kamar</a></li>
                    <li><a href="#fasilitas" class="hover:text-indigo-400">Fasilitas</a></li>
                    <li><a href="#kontak" class="hover:text-indigo-400">Kontak</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold text-white mb-3">Kontak</h4>
                <ul class="space-y-2">
                    <li>📞 0812-3456-7890</li>
                    <li>✉️ kosharmoni@gmail.com</li>
                    <li>📍 Jl. Harmoni No. 21, Yogyakarta</li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold text-white mb-3">Ikuti Kami</h4>
                <div class="flex space-x-4 text-xl">
                    <a href="#" class="hover:text-indigo-400">🌐</a>
                    <a href="#" class="hover:text-indigo-400">📘</a>
                    <a href="#" class="hover:text-indigo-400">📸</a>
                </div>
            </div>

        </div>

        <div class="border-t border-gray-700 py-5 text-center text-gray-500 text-sm">
            © 2025 Kos Harmoni — All Rights Reserved
        </div>
    </footer>



    </style>
</div>