<?php

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state(['email' => '']);

rules(['email' => ['required', 'string', 'email']]);

$sendPasswordResetLink = function () {
    $this->validate();

    $status = Password::sendResetLink(
        $this->only('email')
    );

    if ($status != Password::RESET_LINK_SENT) {
        $this->addError('email', __($status));

        return;
    }

    $this->reset('email');

    Session::flash('status', __($status));
};

?>

<div class="w-full h-auto from-[#0f172a] to-[#1e293b] flex flex-col justify-start items-center p-4">
    <div class="w-full max-w-xl mx-auto bg-[#1e293b] rounded-xl p-6">
        <div class="mb-6 text-sm text-[#e2e8f0]">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <form wire:submit="sendPasswordResetLink">
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" class="text-[#e2e8f0]" />
                <x-text-input 
                    wire:model="email" 
                    id="email" 
                    class="w-full h-12 rounded-xl bg-[#334155] border border-[#475569] px-4 text-[#e2e8f0] mt-2"
                    type="email" 
                    name="email" 
                    required 
                    autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex justify-end mt-6">
                <x-primary-button class="bg-blue-500 hover:bg-blue-400 text-white px-6 py-3 rounded-xl transition-colors duration-200">
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
