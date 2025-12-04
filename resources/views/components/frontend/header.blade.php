<header x-data="{ open:false }" class="fixed w-full top-0 bg-white/80 backdrop-blur shadow-sm z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        <h1 class="text-2xl font-bold text-indigo-600">Kos Harmoni</h1>

        <!-- DESKTOP NAV -->
        <nav class="hidden md:flex space-x-8 text-gray-700 font-medium">
            <a href="/" class="hover:text-indigo-600">Beranda</a>
            <a href="/#kamar" class="hover:text-indigo-600">Kamar</a>
            <a href="/#fasilitas" class="hover:text-indigo-600">Fasilitas</a>
            <a href="/#kontak" class="hover:text-indigo-600">Kontak</a>
        </nav>

        <!-- MOBILE BUTTON -->
        <button @click="open = !open" class="md:hidden text-gray-700">
            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <!-- MOBILE NAV -->
    <div x-show="open" x-transition class="md:hidden px-6 pb-4 bg-white border-t shadow">
        <a href="/" class="block py-2 text-gray-700">Beranda</a>
        <a href="/#kamar" class="block py-2 text-gray-700">Kamar</a>
        <a href="/#fasilitas" class="block py-2 text-gray-700">Fasilitas</a>
        <a href="/#kontak" class="block py-2 text-gray-700">Kontak</a>
    </div>
</header>
