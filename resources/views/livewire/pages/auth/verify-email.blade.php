<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\layout;

layout('layouts.guest');

$sendVerification = function () {
    if (Auth::user()->hasVerifiedEmail()) {
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);

        return;
    }

    Auth::user()->sendEmailVerificationNotification();

    Session::flash('status', 'verification-link-sent');
};

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

?>

<div class="w-full h-auto from-[#0f172a] to-[#1e293b] flex flex-col justify-start items-center p-4">
    <div class="w-full max-w-xl mx-auto bg-[#1e293b] rounded-xl p-6">
        <div class="mb-6 text-sm text-[#e2e8f0]">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 text-sm font-medium text-green-400">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <x-primary-button 
                wire:click="sendVerification"
                class="w-full sm:w-auto bg-blue-500 hover:bg-blue-400 text-white px-6 py-3 rounded-xl transition-colors duration-200">
                {{ __('Resend Verification Email') }}
            </x-primary-button>

            <button 
                wire:click="logout" 
                type="submit" 
                class="text-sm text-blue-400 hover:text-blue-300 transition-colors duration-200">
                {{ __('Log Out') }}
            </button>
        </div>
    </div>
</div>