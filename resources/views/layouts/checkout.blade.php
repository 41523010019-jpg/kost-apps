<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Checkout' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tailwind CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @livewireStyles
</head>
<body class="bg-gray-100 min-h-screen font-sans antialiased">

    {{-- Navbar sederhana --}}
    <nav class="bg-white shadow-md py-4 mb-6">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold text-blue-600">MyShop</a>
            <div>
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-600 transition mx-2">Beranda</a>
                
        </div>
    </nav>

    {{-- Main content --}}
    <main class="max-w-6xl mx-auto px-4 mb-12">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-white shadow-inner py-6 mt-12">
        <div class="max-w-6xl mx-auto text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} Lagikoding Shop. All rights reserved.
        </div>
    </footer>

    @livewireStyles
@livewireScripts

    @stack('scripts')
</body>
</html>
