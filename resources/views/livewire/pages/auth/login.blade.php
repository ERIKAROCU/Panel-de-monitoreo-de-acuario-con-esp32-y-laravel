<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.guest');

form(LoginForm::class);

$login = function () {
    $this->validate();
    $this->form->authenticate();
    Session::regenerate();
    $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
};

?>

<div>
    
    {{-- Título central --}}
    <div class="flex flex-col items-center mb-6">
        <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white">
            Iniciar Sesión
        </h2>
        
        {{-- INICIO: IMAGEN AÑADIDA CON TU RUTA --}}
        <img src="{{ asset('images/ACUARIO.jpg') }}" 
             alt="Logo Acuario" 
             class="w-40 h-41 mx-auto mt-4 mb-4 object-contain rounded-full"> {{-- Añadido rounded-full, puedes quitarlo si no te gusta --}}
        {{-- FIN: IMAGEN AÑADIDA --}}

    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- Formulario con espaciado y colores azules --}}
    <form wire:submit="login" class="space-y-6">
        
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" 
                class="block mt-1 w-full focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600" 
                type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input wire:model="form.password" id="password" 
                class="block mt-1 w-full focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600"
                type="password"
                name="password"
                required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <div class="block">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox" 
                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:focus:ring-blue-600" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" 
                   href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div>
            <button type="submit" 
                    class="w-full justify-center inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                {{ __('Log in') }}
            </button>
        </div>
        
    </form>
</div>