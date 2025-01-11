<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

use function Livewire\Volt\state;

state([
    'name' => '',
    'lastname' => '',
    'email' => '',
    'phone_number' => '',
    'password' => '',
    'password_confirmation' => '',
]);

$createUser = function () {
    $validated = $this->validate([
        'name' => ['required', 'string', 'max:255'],
        'lastname' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
        'phone_number' => ['required', 'string', 'max:255'],
        'password' => ['required', 'string', 'confirmed', Password::defaults()],
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'lastname' => $validated['lastname'],
        'email' => $validated['email'],
        'phone_number' => $validated['phone_number'],
        'password' => Hash::make($validated['password']),
    ]);

    $this->dispatch('close-modal', 'confirm-user-create');

    $user->sendEmailVerificationNotification();

    $this->reset(['name', 'lastname', 'email', 'phone_number', 'password', 'password_confirmation']);
};

?>

<section>
    <header>
        <h2 class="text-lg font-medium text-[#e2e8f0]">
            {{ __('Create New User') }}
        </h2>

        <p class="mt-1 text-sm text-[#94a3b8]">
            {{ __('Create a new user account with the following information.') }}
        </p>
    </header>

    <form wire:submit="createUser" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-[#e2e8f0]" />
            <x-text-input 
                wire:model="name" 
                id="name" 
                name="name" 
                type="text" 
                class="mt-1 block w-full h-12 rounded-xl bg-[#252f3f] border border-[#475569] px-4 text-[#e2e8f0] focus:border-[#475569] focus:ring focus:ring-[#475569] focus:ring-opacity-50"  
                autocomplete="name" 
                required autofocus
            />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="lastname" :value="__('Lastname')" class="text-[#e2e8f0]" />
            <x-text-input 
                wire:model="lastname" 
                id="lastname" 
                name="lastname" 
                type="text" 
                class="mt-1 block w-full h-12 rounded-xl bg-[#252f3f] border border-[#475569] px-4 text-[#e2e8f0] focus:border-[#475569] focus:ring focus:ring-[#475569] focus:ring-opacity-50"  
                autocomplete="lastname" 
                required autofocus
            />
            <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#e2e8f0]" />
            <x-text-input 
                wire:model="email" 
                id="email" 
                name="email" 
                type="email" 
                class="mt-1 block w-full h-12 rounded-xl bg-[#252f3f] border border-[#475569] px-4 text-[#e2e8f0] focus:border-[#475569] focus:ring focus:ring-[#475569] focus:ring-opacity-50"  
                autocomplete="email" 
                required autofocus
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="phone_number" :value="__('Phone number')" class="text-[#e2e8f0]" />
            <x-text-input 
                wire:model="phone_number" 
                id="phone_number" 
                name="phone_number" 
                type="text" 
                class="mt-1 block w-full h-12 rounded-xl bg-[#252f3f] border border-[#475569] px-4 text-[#e2e8f0] focus:border-[#475569] focus:ring focus:ring-[#475569] focus:ring-opacity-50"  
                autocomplete="phone_number" 
                required autofocus
            />
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" class="text-[#e2e8f0]" />
            <x-text-input 
                wire:model="password" 
                id="password" 
                name="password" 
                type="password" 
                class="mt-1 block w-full h-12 rounded-xl bg-[#252f3f] border border-[#475569] px-4 text-[#e2e8f0] focus:border-[#475569] focus:ring focus:ring-[#475569] focus:ring-opacity-50"  
                autocomplete="password" 
                required autofocus
            />
            <x-input-error class="mt-2" :messages="$errors->get('password')" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-[#e2e8f0]" />
            <x-text-input 
                wire:model="password_confirmation" 
                id="password_confirmation" 
                name="password_confirmation" 
                type="password" 
                class="mt-1 block w-full h-12 rounded-xl bg-[#252f3f] border border-[#475569] px-4 text-[#e2e8f0] focus:border-[#475569] focus:ring focus:ring-[#475569] focus:ring-opacity-50"  
                autocomplete="password_confirmation" 
                required autofocus
            />
            <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="mt-6 flex items-center">
            <div class="ml-auto flex items-center">
                <x-secondary-button x-on:click.prevent="$dispatch('close-modal', 'confirm-user-create')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Create User') }}
                </x-primary-button>
            </div>
        </div>
    </form>
</section>