<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

use function Livewire\Volt\state;

$currentUser = Auth::user();

$getUserProperty = fn($userToEdit, $property = null) =>
    $property === null
    ? (is_numeric($userToEdit) ? User::find($userToEdit) : ($userToEdit instanceof User ? $userToEdit : $currentUser))
    : (is_numeric($userToEdit) ? User::find($userToEdit)->$property : ($userToEdit instanceof User ? $userToEdit->$property : $currentUser->$property));

state([
    'userToEdit' => fn () => null,
    'name' => fn () => $getUserProperty($this->userToEdit, 'name'),
    'lastname' => fn () => $getUserProperty($this->userToEdit, 'lastname'),
    'email' => fn () => $getUserProperty($this->userToEdit, 'email'),
    'phone_number' => fn () => $getUserProperty($this->userToEdit, 'phone_number')
]);

$updateProfileInformation = function () use ($getUserProperty, $currentUser) {
    $this->user = $getUserProperty($this->userToEdit);

    $validated = $this->validate([
        'name' => ['required', 'string', 'max:255'],
        'lastname' => ['required', 'string', 'max:255'],
        'email' => [
            'required',
            'string',
            'email',
            'lowercase',
            'max:255',
            'regex:/^[^@]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,6}$/',
            Rule::unique('users')->ignore($this->user->id)
        ],
        'phone_number' => ['required', 'string', 'max:255', 'regex:/^\+?[0-9\s]+$/']
    ]);

    $this->user->fill($validated);

    if ($this->user->isDirty('email')) {
        $this->user->email_verified_at = null;
    }

    $this->user->save();

    if(isset($this->userToEdit)) {
        $this->dispatch('profile-updated', name: $currentUser->name . ' ' . $currentUser->lastname);
        $this->dispatch('close-modal', 'confirm-user-edit');
    } else {
        $this->dispatch('profile-updated', name: $this->user->name . ' ' . $this->user->lastname);
    }
};

$sendVerification = function () use ($getUserProperty) {
    $this->user = $getUserProperty($this->userToEdit);

    if ($this->user->hasVerifiedEmail()) {
        $this->redirectIntended(route('dashboard', absolute: false));
        return;
    }

    try {
        $this->user->sendEmailVerificationNotification();
    } catch (\Exception $e) {
        \Log::error("The email could not be sent.", ['exception' => $e]);
    }

    Session::flash('status', 'verification-link-sent');
};

$getTitle = fn() => $this->userToEdit
    ? __('Profile Information')
    : __('Update User Profile');

$getDescription = fn() => $this->userToEdit
    ? __("Update your account's profile information and email address.")
    : __("Update user's profile information and email address.");

$getSavedMessage = fn() => $this->userToEdit
    ? __('Your profile has been updated.')
    : __('User profile has been updated.');
?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ $this->getTitle() }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ $this->getDescription() }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="block w-full mt-1" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="lastname" :value="__('Lastname')" />
            <x-text-input wire:model="lastname" id="lastname" name="lastname" type="text" class="block w-full mt-1" required autofocus autocomplete="lastname" />
            <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="block w-full mt-1" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($userToEdit instanceof MustVerifyEmail && ! $userToEdit->hasVerifiedEmail())
            <div>
                <p class="mt-2 text-sm text-gray-800 dark:text-gray-200">
                    {{ $this->userToEdit
                        ? __('Your email address is unverified.')
                        : __('This user\'s email address is unverified.') }}

                    <button wire:click.prevent="sendVerification" class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        {{ $this->userToEdit
                            ? __('Click here to re-send the verification email.')
                            : __('Click here to send a verification email to this user.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                        {{ $this->userToEdit
                            ? __('A new verification link has been sent to your email address.')
                            : __('A verification link has been sent to the user\'s email address.') }}
                    </p>
                @endif
            </div>
            @endif
        </div>

        <div>
            <x-input-label for="phone_number" :value="__('Phone number')" />
            <x-text-input wire:model="phone_number" id="phone_number" name="phone_number" type="text" class="block w-full mt-1" required autofocus autocomplete="phone_number" />
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
        </div>

        <div class="flex items-center mt-6">
            <x-action-message class="me-3" on="profile-updated">
                {{ $this->getSavedMessage() }}
            </x-action-message>

            <div class="flex items-center ml-auto">
                @if($userToEdit)
                    <x-secondary-button x-on:click.prevent="$dispatch('close-modal', 'confirm-user-edit')">
                        {{ __('Cancel') }}
                    </x-secondary-button>
                @endif

                <x-primary-button class="ms-3">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </div>
    </form>
</section>
