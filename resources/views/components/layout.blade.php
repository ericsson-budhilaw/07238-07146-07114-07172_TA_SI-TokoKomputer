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

    <div class="{{ isset($divCSS) ? $divCSS : '' }}">
        <!-- Page Content -->
        <main class="{{ isset($mainCSS) ? $mainCSS : '' }}">
            {{ $slot }}
        </main>
    </div>

    <!-- Footer -->
    <livewire:footer />

    @livewireScripts

    <livewire:cart-component />

    <script>
        function toggleModal()
        {
            const modal = document.getElementById('modal')
            modal.className = 'modal opacity-0 pointer-events-none fixed' +
                'w-full h-full top-0 left-0 flex items-center justify-end hidden'
        }

        function mobileMenu()
        {
            const showMenu = document.getElementById('mobile-menu')
            showMenu.classList.toggle('hidden')
        }

        function userMenu()
        {
            const showMenu = document.getElementById('user-account-navigation')
            showMenu.classList.toggle('hidden');
        }

        const overlay = document.querySelector('.modal-overlay')
        overlay.addEventListener('click', toggleModal)

        function decrement(e) {
            const btn = e.target.parentNode.parentElement.querySelector(
                'button[data-action="decrement"]'
            );
            const target = btn.nextElementSibling;
            let value = Number(target.value);
            value--;
            target.value = value;
        }

        function increment(e) {
            const btn = e.target.parentNode.parentElement.querySelector(
                'button[data-action="decrement"]'
            );
            const target = btn.nextElementSibling;
            let value = Number(target.value);
            value++;
            target.value = value;
        }

        const decrementButtons = document.querySelectorAll(
            `button[data-action="decrement"]`
        );

        const incrementButtons = document.querySelectorAll(
            `button[data-action="increment"]`
        );

        decrementButtons.forEach(btn => {
            btn.addEventListener("click", decrement);
        });

        incrementButtons.forEach(btn => {
            btn.addEventListener("click", increment);
        });
    </script>
</body>
</html>
