<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Buku Koding Store')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

    {{-- Header --}}
    <header class="bg-white shadow py-4">
        <div class="max-w-6xl mx-auto px-6 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">Buku Koding Store</a>
            <nav class="space-x-4">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">Produk</a>
               
            </nav>
        </div>
    </header>

    {{-- Konten utama --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white shadow py-4 mt-8">
        <div class="max-w-6xl mx-auto px-6 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} Buku Koding Store. All rights reserved.
        </div>
    </footer>
 @livewireScripts
</body>
</html>
