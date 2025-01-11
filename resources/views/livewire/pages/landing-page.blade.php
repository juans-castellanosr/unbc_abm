<?php
use function Livewire\Volt\layout;

layout('layouts.app');

?>

<div class="min-h-[80vh] font-sans">
    <div class="relative overflow-hidden flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-4xl mx-auto text-center py-12 sm:py-20 lg:py-24">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4 sm:mb-6 animate-fade">
                User Management System
            </h1>
            <p class="text-slate-400 text-base sm:text-lg lg:text-xl mb-8 sm:mb-10 max-w-2xl mx-auto">
                Effortless user administration and control
            </p>
            <div class="flex justify-center">
                <x-action-button href="{{ route('login') }}" wire:navigate>
                    Get Started
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </x-action-button>
            </div>
        </div>
    </div>

    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            <div class="group bg-gradient-to-r from-gray-800 to-gray-700 border border-slate-600/50 rounded-xl p-6 sm:p-8 text-center hover:border-indigo-500/50 transition-all duration-300">
                <div class="w-12 h-12 bg-indigo-500 rounded-full mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h3 class="text-slate-100 text-lg sm:text-xl font-semibold mb-3">User Management</h3>
                <p class="text-slate-400 text-sm sm:text-base">Easy CRUD operations for seamless user administration</p>
            </div>

            <div class="group bg-gradient-to-r from-gray-800 to-gray-700 border border-slate-600/50 rounded-xl p-6 sm:p-8 text-center hover:border-indigo-500/50 transition-all duration-300">
                <div class="w-12 h-12 bg-indigo-500 rounded-full mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h3 class="text-slate-100 text-lg sm:text-xl font-semibold mb-3">Secure Access</h3>
                <p class="text-slate-400 text-sm sm:text-base">Protected data with advanced security measures</p>
            </div>

            <div class="group bg-gradient-to-r from-gray-800 to-gray-700 border border-slate-600/50 rounded-xl p-6 sm:p-8 text-center hover:border-indigo-500/50 transition-all duration-300">
                <div class="w-12 h-12 bg-indigo-500 rounded-full mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h3 class="text-slate-100 text-lg sm:text-xl font-semibold mb-3">Real-time Updates</h3>
                <p class="text-slate-400 text-sm sm:text-base">Instant changes with live data synchronization</p>
            </div>
        </div>
    </div>
</div>
