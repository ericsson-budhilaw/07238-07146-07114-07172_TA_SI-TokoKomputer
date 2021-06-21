<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SinGameShop | Toko Komputer Terlengkap di Surabaya</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome.css')  }}" rel="stylesheet">
    @livewireStyles
</head>
<body class="font-sans antialiased">
    <!-- Header -->
    <livewire:navbar />

    <div class="min-h-screen">
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Footer -->
    <livewire:footer />

    @livewireScripts

    <livewire:cart-component>

    <script>
        function toggleModal()
        {
            const modal = document.getElementById('modal')
            modal.className = 'modal opacity-0 pointer-events-none fixed' +
                'w-full h-full top-0 left-0 flex items-center justify-end'
        }

        function mobileMenu()
        {
            const showMenu = document.getElementById('mobile-menu')
            showMenu.classList.toggle('hidden')
        }

        const overlay = document.querySelector('.modal-overlay')
        overlay.addEventListener('click', toggleModal)
    </script>
</body>
</html>
