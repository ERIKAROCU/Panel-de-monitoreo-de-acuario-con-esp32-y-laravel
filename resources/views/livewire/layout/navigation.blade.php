<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

?>

<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <!-- Enlace Dashboard -->
                    <x-nav-link 
                        :href="route('dashboard', ['tab' => 'dashboard'])" 
                        :active="request()->query('tab', 'dashboard') == 'dashboard'" 
                        wire:navigate>
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    
                    <!-- NUEVO: Enlace Control -->
                    <x-nav-link 
                        :href="route('dashboard', ['tab' => 'control'])" 
                        :active="request()->query('tab') == 'control'" 
                        wire:navigate>
                        {{ __('Control') }}
                    </x-nav-link>

                    <!-- Enlace Gráfico -->
                    <x-nav-link 
                        :href="route('dashboard', ['tab' => 'charts'])" 
                        :active="request()->query('tab') == 'charts'" 
                        wire:navigate>
                        {{ __('Gráfico') }}
                    </x-nav-link>

                    <!-- Enlace Historial -->
                    <x-nav-link 
                        :href="route('dashboard', ['tab' => 'historial'])" 
                        :active="request()->query('tab') == 'historial'" 
                        wire:navigate>
                        {{ __('Historial') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                {{-- ... Tu código de dropdown de settings ... --}}
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                {{-- ... Tu código de botón hamburger ... --}}
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!-- Enlace Dashboard -->
            <x-responsive-nav-link 
                :href="route('dashboard', ['tab' => 'dashboard'])" 
                :active="request()->query('tab', 'dashboard') == 'dashboard'" 
                wire:navigate>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <!-- NUEVO: Enlace Control -->
            <x-responsive-nav-link 
                :href="route('dashboard', ['tab' => 'control'])" 
                :active="request()->query('tab') == 'control'" 
                wire:navigate>
                {{ __('Control') }}
            </x-responsive-nav-link>

            <!-- Enlace Gráfico -->
            <x-responsive-nav-link 
                :href="route('dashboard', ['tab' => 'charts'])" 
                :active="request()->query('tab') == 'charts'" 
                wire:navigate>
                {{ __('Gráfico') }}
            </x-responsive-nav-link>

            <!-- Enlace Historial -->
            <x-responsive-nav-link 
                :href="route('dashboard', ['tab' => 'historial'])" 
                :active="request()->query('tab') == 'historial'" 
                wire:navigate>
                {{ __('Historial') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            {{-- ... Tu código de responsive settings ... --}}
        </div>
    </div>
</nav>
