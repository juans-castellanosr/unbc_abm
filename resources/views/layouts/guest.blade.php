<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-100 text-slate-100 dark:bg-gray-900">
    <x-circles></x-circles>

    <div class="flex flex-col justify-between min-h-screen bg-gray-100 dark:bg-gray-900">
        <livewire:layout.navigation wire:key="guest-navigation" />

        <main class="flex flex-col items-center flex-grow px-4 pt-6 sm:justify-center sm:pt-0 sm:px-6 md:px-8">
            <div class="w-full px-6 py-4 mt-6 overflow-hidden sm:max-w-md sm:rounded-lg">
                {{ $slot }}
            </div>
        </main>

        <livewire:layout.footer wire:key="guest-footer" />
    </div>
    @livewireScripts
</body>

</html>
