<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use function Livewire\Volt\rules;
use function Livewire\Volt\state;

state([
    'password' => '',
    'userToDelete' => null
]);

rules(['password' => ['required', 'string', 'current_password']]);

$deleteUser = function (Logout $logout) {
    $this->validate();

    if ($this->userToDelete) {
        User::findOrFail($this->userToDelete)->delete();
    } else {
        tap(Auth::user(), $logout(...))->delete();
        $this->redirect('/', navigate: true);
    }

    $this->dispatch('profile-deleted');

    $this->dispatch('close-modal', 'confirm-user-delete');
};

$getDescription = fn() => $this->userToDelete
    ? __('Once this account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete this account.')
    : __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.');

$getDeleteMessage = fn() => $this->userToDelete
    ? __('Your profile has been deleted.')
    : __('User profile has been deleted.');
?>

<section>
    <h2 class="text-lg font-medium text-[#e2e8f0]">
        {{ __('Are you sure you want to proceed with deletion?') }}
    </h2>

    <p class="mt-1 text-sm text-[#94a3b8]">
        {{ $this->getDescription() }}
    </p>
    <form wire:submit="deleteUser" class="mt-6 space-y-6">
        <div class="mt-6">
            <x-text-input
                wire:model="password"
                id="password"
                name="password"
                type="password"
                class="mt-1 block w-full h-12 rounded-xl bg-[#252f3f] border border-[#475569] px-4 text-[#e2e8f0] focus:border-[#475569] focus:ring focus:ring-[#475569] focus:ring-opacity-50"
                placeholder="{{ __('Your Password') }}"
                autocomplete="password"
                autocorrect="off"
                autocapitalize="off"
                autofill="false"
                required
                autofocus
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center mt-6">
            <x-action-message class="me-3" on="profile-deleted">
                {{ $this->getDeleteMessage() }}
            </x-action-message>

            <div class="flex items-center ml-auto">
                <x-secondary-button x-on:click.prevent="$dispatch('close-modal', 'confirm-user-delete')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete') }}
                </x-danger-button>
            </div>
        </div>
    </form>
</section>
