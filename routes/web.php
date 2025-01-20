<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('/', 'pages.landing-page')
        ->name('landing-page');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('dashboard', 'pages.dashboard')
        ->name('dashboard');

    Volt::route('profile', 'pages.profile')
        ->name('profile');
});

require __DIR__ . '/auth.php';
