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

        window.livewire.on('checkoutSubmit', (data) => {
            let addressText = document.getElementById('addressText').value;
            let noted       = document.getElementById('noted').value;
            let content = data.content;
            let total   = data.total;

            window.livewire.emit('orderProceed', { address: addressText, noted, content, total });
        });

        window.livewire.on('alert_remove', () => {
            const alert = document.getElementById('alert')
            setTimeout(function () { alert.classList.add('hidden'); }, 3000);
        });

        window.livewire.on('single_file_choosed', function() {
            try {
                let file = event.target.files[0];
                if(file) {
                    let reader = new FileReader();
                    reader.onloadend = () => {
                        window.livewire.emit('single_file_uploaded', reader.result);
                    }
                    reader.readAsDataURL(file);
                }
            } catch (error) {
                console.log(error)
            }
        })
    </script>
</body>
</html>
