<header x-data="{ open: false }" class="fixed w-full top-0 backdrop-blur shadow-sm z-50 bg-white text-gray-700 transition-colors duration-300">

    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        <a href="/" wire:navigate
           class="text-2xl font-bold text-indigo-600 hover:text-indigo-500 transition">
            {{ $webSetting?->site_title ?? 'Kos Harmoni' }}
        </a>

        <!-- DESKTOP NAV -->
        <nav class="hidden md:flex space-x-4 font-medium items-center">
            <a href="/" class="hover:text-indigo-600">Beranda</a>
            <a href="/#kamar" class="hover:text-indigo-600">Kamar</a>
            <a href="/#fasilitas" class="hover:text-indigo-600">Fasilitas</a>
            <a href="/#kontak" class="hover:text-indigo-600">Kontak</a>

            @guest
                <flux:button wire:navigate href="{{ route('login') }}" variant="primary" color="blue">Login</flux:button>
                <flux:button wire:navigate href="{{ route('register') }}" variant="filled" color="indigo">Register</flux:button>
            @else
                <flux:button wire:navigate href="/dashboard" variant="subtle" color="emerald">Dashboard</flux:button>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <flux:button type="submit" variant="danger" color="red">Logout</flux:button>
                </form>
            @endguest
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
    <div x-show="open" @click.away="open = false" x-transition class="md:hidden px-6 pb-4 border-t shadow bg-white text-gray-700 border-gray-200">
        <a href="/" class="block py-2" @click="open = false">Beranda</a>
        <a href="/#kamar" class="block py-2" @click="open = false">Kamar</a>
        <a href="/#fasilitas" class="block py-2" @click="open = false">Fasilitas</a>
        <a href="/#kontak" class="block py-2" @click="open = false">Kontak</a>

        @guest
            <flux:button wire:navigate href="{{ route('login') }}" variant="primary" color="sky" class="w-full mb-2" @click="open = false">Login</flux:button>
            <flux:button wire:navigate href="{{ route('register') }}" variant="filled" color="violet" class="w-full" @click="open = false">Register</flux:button>
        @else
            <flux:button wire:navigate href="/dashboard" variant="subtle" color="emerald" class="w-full mb-2" @click="open = false">Dashboard</flux:button>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <flux:button type="submit" variant="danger" color="red" class="w-full" @click="open = false">Logout</flux:button>
            </form>
        @endguest
    </div>
</header>
