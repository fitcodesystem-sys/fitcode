<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="flex min-h-screen flex-col items-center justify-center bg-zinc-950 px-4 py-8">
            <div>
                <a href="/">
                    <x-application-logo class="h-24 w-auto  fill-current text-rose-400" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-10 px-6 py-4 bg-zinc-900 overflow-hidden sm:rounded-lg rounded-xl border border-zinc-800 shadow-xl shadow-black/20">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
