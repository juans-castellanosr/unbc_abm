<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state('token')->locked();

state([
    'email' => fn () => request()->string('email')->value(),
    'password' => '',
    'password_confirmation' => ''
]);

rules([
    'token' => ['required'],
    'email' => ['required', 'string', 'email'],
    'password' => [
            'required',
            'string',
            'confirmed',
            Rules\Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()
        ]
]);

$resetPassword = function () {
    $this->validate();

    $status = Password::reset(
        $this->only('email', 'password', 'password_confirmation', 'token'),
        function ($user) {
            $user->forceFill([
                'password' => Hash::make($this->password),
                'remember_token' => Str::random(60),
            ])->save();

            event(new PasswordReset($user));
        }
    );

    if ($status != Password::PASSWORD_RESET) {
        $this->addError('email', __($status));

        return;
    }

    Session::flash('status', __($status));

    $this->redirectRoute('login', navigate: true);
};

?>

<div class="w-full h-auto from-[#0f172a] to-[#1e293b] flex flex-col justify-start items-center p-4">
    <div class="w-full max-w-xl mx-auto bg-[#1e293b] rounded-xl p-6">
        <form wire:submit="resetPassword">
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" class="text-[#e2e8f0]" />
                <x-text-input
                    wire:model="email"
                    id="email"
                    class="w-full h-12 rounded-xl bg-[#334155] border border-[#475569] px-4 text-[#e2e8f0] mt-2"
                    type="email"
                    name="email"
                    required
                    autofocus
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" class="text-[#e2e8f0]" />
                <x-text-input
                    wire:model="password"
                    id="password"
                    class="w-full h-12 rounded-xl bg-[#334155] border border-[#475569] px-4 text-[#e2e8f0] mt-2"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mb-6">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-[#e2e8f0]" />
                <x-text-input
                    wire:model="password_confirmation"
                    id="password_confirmation"
                    class="w-full h-12 rounded-xl bg-[#334155] border border-[#475569] px-4 text-[#e2e8f0] mt-2"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex justify-end">
                <x-primary-button class="px-6 py-3 text-white transition-colors duration-200 bg-blue-500 hover:bg-blue-400 rounded-xl">
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
