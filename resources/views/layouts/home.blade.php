{{-- resources/views/layouts/home.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kosku</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    
</head>

<body class="min-h-screen bg-gray-50 font-inter">

     @include('components.frontend.header')

    {{-- CONTENT --}}
    <main class="pt-24">
        {{ $slot }}
    </main>

    {{-- FOOTER --}}
    @include('components.frontend.footer')

    @livewireScripts
</body>
</html>
