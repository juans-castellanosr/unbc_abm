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

<body class="font-sans antialiased text-slate-100 bg-gray-100 dark:bg-gray-900">
    <x-circles></x-circles>

    <div class="min-h-screen flex flex-col justify-between bg-gray-100 dark:bg-gray-900">
        <livewire:layout.navigation wire:key="guest-navigation" />

        <main class="flex-grow flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4 sm:px-6 md:px-8">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </main>

        <livewire:layout.footer wire:key="guest-footer" />
    </div>
    @livewireScripts
</body>

</html>