<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use function Livewire\Volt\state;
use function Livewire\Volt\layout;
use function Livewire\Volt\on;

layout('layouts.app');

state([
    'search' => '',
    'users' => fn() => $this->getUsers(),
    'userIdToEdit' => null,
    'userIdToDelete' => null
]);

$getUsers = function () {
    $query = User::where('id', '!=', Auth::id())
                ->orderByRaw("CONCAT(name, ' ', lastname) ASC");

    if ($this->search) {
        $query->where(function ($query) {
            $query->whereRaw("CONCAT(name, ' ', lastname) LIKE ?", ['%' . $this->search . '%'])
                  ->orWhere('name', 'LIKE', '%' . $this->search . '%')
                  ->orWhere('lastname', 'LIKE', '%' . $this->search . '%')
                  ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                  ->orWhere('phone_number', 'LIKE', '%' . $this->search . '%');
        });
    }

    $this->users = $query->get();

    return $this->users;
};

on([
    'echo:private-users-channel,UserDatabaseChanged' => fn () => $this->getUsers()
]);

?>

<div class="w-full h-auto from-[#0f172a] to-[#1e293b] flex flex-col justify-start items-center p-4">
    <div class="w-full mx-auto max-w-7xl">
        <div class="flex flex-col w-full gap-4 mb-6 sm:flex-row">
            <x-text-input
                class="w-full sm:flex-1 h-12 rounded-xl bg-[#1e293b] border border-[#475569] px-4"
                type="text"
                wire:model.live="search"
                wire:input="getUsers"
                id="search"
                name="search"
                autocomplete="search"
                placeholder="Search"
                required
                autofocus
            />
            <x-action-button x-on:click.prevent="$dispatch('open-modal', 'confirm-user-create')">
                + Add User
            </x-action-button>
        </div>

        <div class="w-full bg-[#1e293b] rounded-xl overflow-hidden">
            <div class="sticky top-0 h-12 bg-[#334155] flex items-center px-4">
                <div class="flex justify-between w-full text-sm text-[#e2e8f0] font-medium">
                    <span class="hidden w-1/4 text-left sm:block">Name</span>
                    <span class="block w-1/4 text-left sm:hidden">Information</span>
                    <span class="hidden w-1/4 text-left sm:block">Email</span>
                    <span class="hidden w-1/4 text-left sm:block">Phone</span>
                    <span class="w-full text-right sm:w-20">Actions</span>
                </div>
            </div>

            <div class="max-h-[calc(80vh-200px)] overflow-y-auto">
                @foreach ($users as $user)
                <div class="min-h-[48px] py-2 border-b border-[#475569] flex items-center px-4 hover:bg-[#252f3f]">
                    <div class="flex flex-col sm:flex-row justify-between w-full text-sm text-[#e2e8f0] gap-1">
                        <span class="w-full text-left sm:w-1/4">
                            <span class="sm:hidden text-[#94a3b8]">Name: </span>
                            {{ $user->name }} {{ $user->lastname }}
                        </span>
                        <span class="w-full text-left sm:w-1/4">
                            <span class="sm:hidden text-[#94a3b8]">Email: </span>
                            {{ $user->email }}
                        </span>
                        <span class="w-full text-left sm:w-1/4">
                            <span class="sm:hidden text-[#94a3b8]">Phone: </span>
                            {{ $user->phone_number }}
                        </span>
                        <span class="w-full text-right sm:w-auto sm:text-left">
                            <button
                                wire:click="$set('userIdToEdit', {{ $user->id }})"
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-edit')"
                                class="text-blue-500 transition-colors duration-200 hover:text-blue-400">
                                Edit
                            </button>
                            <span class="mx-2 text-[#475569]">|</span>
                            <button
                                wire:click="$set('userIdToDelete', {{ $user->id }})"
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-delete')"
                                class="text-red-500 transition-colors duration-200 hover:text-red-400">
                                Delete
                            </button>
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <x-modal name="confirm-user-create" :show="$errors->isNotEmpty()" focusable>
        <livewire:profile.create-profile-form wire:key="modal-create-profile-{{ uniqid() }}" />
    </x-modal>

    <x-modal name="confirm-user-edit" :show="$errors->isNotEmpty()" focusable>
        <livewire:profile.update-profile-information-form :userToEdit="$userIdToEdit" wire:key="modal-update-profile-{{ $userIdToEdit }}" />
    </x-modal>

    <x-modal name="confirm-user-delete" :show="$errors->isNotEmpty()" focusable>
        <livewire:profile.delete-user-form :userToDelete="$userIdToDelete" wire:key="modal-delete-profile-{{ $userIdToDelete }}" />
    </x-modal>
</div>
