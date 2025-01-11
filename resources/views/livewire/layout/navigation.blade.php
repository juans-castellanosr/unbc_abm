<?php
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Actions\Logout;

use function Livewire\Volt\state;

$currentUser = Auth::user();

$logout = function (Logout $logout) {
  $logout();

  $this->redirect('/', navigate: true);
};

state([
    'name' => fn () => isset($currentUser) ? json_encode(['name' => $currentUser->name . ' ' . $currentUser->lastname]) : null
]);

?>

<div>
    <nav x-data="{ 
        open: false,
        atTop: true,
        lastScroll: 0,
        hidden: false,
        init() {
            window.addEventListener('scroll', () => {
                const currentScroll = window.pageYOffset;
                this.atTop = currentScroll <= 0;
                if (!this.atTop) {
                    if (currentScroll > this.lastScroll) {
                        this.hidden = true;
                    } else {
                        this.hidden = false;
                    }
                }
                this.lastScroll = currentScroll;
            });
        }
    }" 
    class="bg-[#1e293b]/95 backdrop-blur-sm border-b border-[#475569] fixed w-full top-0 transition-transform duration-300 z-50" 
    :class="{ 'translate-y-0': !hidden || atTop, '-translate-y-full': hidden && !atTop }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('landing-page') }}" wire:navigate>
                            <div class="w-10 h-10 bg-indigo-500 rounded-full"></div>
                        </a>
                    </div>

                    @auth
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="space-x-8">
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                                class="text-[#e2e8f0] hover:text-[#94a3b8] transition-colors duration-200" 
                                wire:navigate>
                                {{ __('Dashboard') }}
                            </x-nav-link>
                        </div>
                    </div>
                    @endauth
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    @guest
                    <a href="{{ route('login') }}" wire:navigate
                        class="text-[#e2e8f0] hover:text-[#94a3b8] px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                        Login
                    </a>
                    @endguest

                    @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-[#475569] text-sm leading-4 font-medium rounded-lg text-[#e2e8f0] hover:text-[#94a3b8] hover:border-[#94a3b8] focus:outline-none transition-colors duration-200">
                                <div x-data="{{ $this->name }}"
                                    x-text="name" x-on:profile-updated.window="name = $event.detail.name">
                                </div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile')" wire:navigate 
                                class="text-[#e2e8f0] hover:text-[#94a3b8] hover:bg-[#252f3f] transition-colors duration-200">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <button wire:click="logout" class="w-full text-start">
                                <x-dropdown-link 
                                    class="text-red-400 hover:text-red-300 hover:bg-[#252f3f] transition-colors duration-200">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </button>
                        </x-slot>
                    </x-dropdown>
                    @endauth
                </div>

                <div class="flex items-center sm:hidden">
                    <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-lg text-[#e2e8f0] hover:text-[#94a3b8] transition-colors duration-200">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div :class="{'block': open, 'hidden': !open}" 
            class="sm:hidden bg-[#1e293b] border-t border-[#475569]">
            @auth
            <div class="px-4 pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                    class="block px-3 py-2 rounded-lg text-[#e2e8f0] hover:text-[#94a3b8] transition-colors duration-200" 
                    wire:navigate>
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div>

            <div class="pt-4 pb-1 border-t border-[#475569]">
                <div class="px-4">
                    <div class="font-medium text-base text-[#e2e8f0]"
                        x-data="{{ $this->name }}"
                        x-text="name" x-on:profile-updated.window="name = $event.detail.name">
                    </div>
                </div>

                <div class="mt-3 space-y-1 px-4">
                    <x-responsive-nav-link :href="route('profile')" wire:navigate 
                        class="block px-3 py-2 rounded-lg text-[#e2e8f0] hover:text-[#94a3b8] transition-colors duration-200">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <button wire:click="logout" class="w-full text-start">
                        <x-responsive-nav-link 
                            class="block px-3 py-2 rounded-lg text-red-400 hover:text-red-300 transition-colors duration-200">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </button>
                </div>
            </div>
            @endauth

            @guest
            <div class="px-4 pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('login')" wire:navigate 
                    class="block px-3 py-2 rounded-lg text-[#e2e8f0] hover:text-[#94a3b8] transition-colors duration-200">
                    {{ __('Login') }}
                </x-responsive-nav-link>
            </div>
            @endguest
        </div>
    </nav>
    <div class="h-16"></div>
</div>