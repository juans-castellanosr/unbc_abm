<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.guest');

form(LoginForm::class);

$login = function () {
    $this->validate();

    $this->form->authenticate();

    Session::regenerate();

    $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
};

?>

<div class="w-full from-[#0f172a] to-[#1e293b] flex justify-center items-center p-4">
    <div class="w-full max-w-md bg-[#1e293b] rounded-xl p-8">
        <div class="flex justify-center mb-8">
            <div class="relative">
                <div class="w-12 h-12 bg-blue-500 rounded-full opacity-80 animate-pulse"></div>
                <div class="absolute inset-0 w-8 h-8 m-auto bg-blue-200 rounded-full"></div>
            </div>
        </div>

        <h2 class="text-center text-2xl text-[#e2e8f0] font-medium mb-8">Welcome Back</h2>

        <form wire:submit="login">
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" class="text-[#e2e8f0]" />
                <x-text-input
                    wire:model="form.email"
                    id="email"
                    class="w-full h-12 rounded-xl bg-[#334155] border border-[#475569] px-4 text-[#e2e8f0] mt-2"
                    type="email"
                    name="email"
                    required
                    autofocus
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" class="text-[#e2e8f0]" />
                <x-text-input
                    wire:model="form.password"
                    id="password"
                    class="w-full h-12 rounded-xl bg-[#334155] border border-[#475569] px-4 text-[#e2e8f0] mt-2"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>

            <div class="mb-6">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox"
                        class="rounded bg-[#334155] border-[#475569] text-blue-500 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-[#e2e8f0]">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-400 transition-colors duration-200 hover:text-blue-300"
                        href="{{ route('password.request') }}" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="w-full px-6 py-3 text-white transition-colors duration-200 bg-blue-500 sm:w-auto hover:bg-blue-400 rounded-xl">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
