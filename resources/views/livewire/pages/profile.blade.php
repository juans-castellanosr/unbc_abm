<?php
use function Livewire\Volt\layout;

layout('layouts.app');

?>

<div class="w-full h-auto from-[#0f172a] to-[#1e293b] flex flex-col justify-start items-center p-4">
    <div class="mx-auto max-w-7xl">
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-[#e2e8f0] leading-tight">
                {{ __('Profile') }}
            </h2>
        </div>

        <div class="space-y-6">
            <div class="p-6 bg-[#1e293b] rounded-xl border border-[#475569] shadow-sm">
                <div class="max-w-xl mx-auto">
                    <livewire:profile.update-profile-information-form wire:key="update-profile-{{ auth()->id() }}" />
                </div>
            </div>

            <div class="p-6 bg-[#1e293b] rounded-xl border border-[#475569] shadow-sm">
                <div class="max-w-xl mx-auto">
                    <livewire:profile.update-password-form wire:key="update-password-{{ auth()->id() }}" />
                </div>
            </div>

            <div class="p-6 bg-[#1e293b] rounded-xl border border-[#475569] shadow-sm">
                <div class="max-w-xl mx-auto">
                    <livewire:profile.delete-user wire:key="delete-user-{{ auth()->id() }}" />
                </div>
            </div>
        </div>
    </div>
</div>
