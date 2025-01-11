<?php
use App\Models\User;
use function Livewire\Volt\state;

state([
    'userToDelete' => null
]);

?>

<section class="space-y-6">
    @if($this->userToDelete)
        <livewire:profile.delete-user-form wire:key="confirm-delete-user-{{ $userToDelete }}" />
    @else
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Delete Account') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting the account, please ensure this action is necessary.') }}
            </p>
        </header>
        <div class="mt-6 flex items-center">
            <x-danger-button x-data="" class="ml-auto flex items-center" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-delete')">
                {{ __('Delete Account') }}
            </x-danger-button>
        </div>

        <x-modal name="confirm-user-delete" :show="$errors->isNotEmpty()" focusable>
            <livewire:profile.delete-user-form wire:key="confirm-delete-user-{{ $userToDelete }}" />
        </x-modal>
    @endif
</section>