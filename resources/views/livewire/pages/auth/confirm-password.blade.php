<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state(['password' => '']);

rules(['password' => ['required', 'string']]);

$confirmPassword = function () {
    $this->validate();

    if (! Auth::guard('web')->validate([
        'email' => Auth::user()->email,
        'password' => $this->password,
    ])) {
        throw ValidationException::withMessages([
            'password' => __('auth.password'),
        ]);
    }

    session(['auth.password_confirmed_at' => time()]);

    $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
};

?>

<div class="w-full h-auto from-[#0f172a] to-[#1e293b] flex flex-col justify-start items-center p-4">
    <div class="w-full max-w-xl mx-auto bg-[#1e293b] rounded-xl p-6">
        <div class="mb-6 text-sm text-[#e2e8f0]">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <form wire:submit="confirmPassword">
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" class="text-[#e2e8f0]" />

                <x-text-input wire:model="password"
                    id="password"
                    class="w-full h-12 rounded-xl bg-[#334155] border border-[#475569] px-4 text-[#e2e8f0] mt-2"
                    type="password"
                    name="password"
                    required 
                    autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-end mt-6">
                <x-primary-button class="bg-blue-500 hover:bg-blue-400 text-white px-6 py-3 rounded-xl transition-colors duration-200">
                    {{ __('Confirm') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
