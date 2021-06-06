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
        <p>Coming soon.</p>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Button
        </button>
{{--        <img src="{{ asset('storage/Gigabyte-RX5600XT.png') }}" alt="">--}}

        <livewire:counter />

        @livewireScripts
    </body>
</html>
