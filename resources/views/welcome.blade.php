<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @livewireStyles
    </head>
    <body class="antialiased">
        <livewire:navbar />
        <section class="hero">
            <div class="mx-auto py-5 container grid gap-4 grid-cols-2">
                <div class="mx-auto">
                    <img src="{{ asset("storage/RTX3090-ASUS.png") }}" alt="ASUS ROG RTX 3090" width="555" height="485" />
                </div>
                <div class="pt-24 antialiased font-sans">
                    <p class="mb-8 text-4xl font-bold text-gray-900">ASUS ROG RTX 3090</p>
                    <p class="text-2xl font-bold tracking-wide text-gray-700">Performa terbaik, suhu yang terjaga</p>
                    <p class="mb-8 text-2xl font-bold tracking-wide text-gray-700">Semua permainan dapat ditaklukan</p>
                    <div class="price-tag grid gap-2 grid-cols-2 w-1/2">
                        <p class="text-1xl text-center p-4 bg-blue-600 text-gray-300 shadow">Rp.16.999.000</p>
                        <button class="text-1xl text-center tracking-wider bg-gray-300 shadow">BELI SEKARANG</button>
                    </div>
                </div>
            </div>
        </section>
{{--        <img src="{{ asset('storage/toko-togo.png') }}" alt="">--}}

        <livewire:counter />

        @livewireScripts
    </body>
</html>
