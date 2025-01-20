<?php
use function Livewire\Volt\layout;

layout('layouts.app');

?>

<div class="min-h-[80vh] font-sans">
    <div class="relative flex items-center justify-center px-4 overflow-hidden sm:px-6 lg:px-8">
        <div class="w-full max-w-4xl py-12 mx-auto text-center sm:py-20 lg:py-24">
            <h1 class="mb-4 text-3xl font-bold text-white sm:text-4xl lg:text-5xl sm:mb-6 animate-fade">
                User Management System
            </h1>
            <p class="max-w-2xl mx-auto mb-8 text-base text-slate-400 sm:text-lg lg:text-xl sm:mb-10">
                Effortless user administration and control
            </p>
            <div class="flex justify-center">
                <x-action-button href="{{ route('login') }}" wire:navigate>
                    Get Started
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </x-action-button>
            </div>
        </div>
    </div>

    <div class="w-full px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8 sm:py-16">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 sm:gap-8">
            <div class="p-6 text-center transition-all duration-300 border group bg-gradient-to-r from-gray-800 to-gray-700 border-slate-600/50 rounded-xl sm:p-8 hover:border-indigo-500/50">
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-6 transition-transform duration-300 bg-indigo-500 rounded-full group-hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h3 class="mb-3 text-lg font-semibold text-slate-100 sm:text-xl">User Management</h3>
                <p class="text-sm text-slate-400 sm:text-base">Easy CRUD operations for seamless user administration</p>
            </div>

            <div class="p-6 text-center transition-all duration-300 border group bg-gradient-to-r from-gray-800 to-gray-700 border-slate-600/50 rounded-xl sm:p-8 hover:border-indigo-500/50">
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-6 transition-transform duration-300 bg-indigo-500 rounded-full group-hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h3 class="mb-3 text-lg font-semibold text-slate-100 sm:text-xl">Secure Access</h3>
                <p class="text-sm text-slate-400 sm:text-base">Protected data with advanced security measures</p>
            </div>

            <div class="p-6 text-center transition-all duration-300 border group bg-gradient-to-r from-gray-800 to-gray-700 border-slate-600/50 rounded-xl sm:p-8 hover:border-indigo-500/50">
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-6 transition-transform duration-300 bg-indigo-500 rounded-full group-hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h3 class="mb-3 text-lg font-semibold text-slate-100 sm:text-xl">Real-time Updates</h3>
                <p class="text-sm text-slate-400 sm:text-base">Instant changes with live data synchronization</p>
            </div>
        </div>
    </div>
</div>
