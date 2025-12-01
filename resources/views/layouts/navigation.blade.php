<!-- EL BLOQUE PHP DE ARRIBA FUE ELIMINADO -->

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

                <!-- Navigation Links (¡Restaurados!) -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <!-- Enlace Dashboard -->
                    <x-nav-link 
                        :href="route('dashboard', ['tab' => 'dashboard'])" 
                        :active="request()->query('tab', 'dashboard') == 'dashboard'" 
                        wire:navigate>
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    
                    <!-- Enlace Gráficos -->
                    <x-nav-link 
                        :href="route('dashboard', ['tab' => 'charts'])" 
                        :active="request()->query('tab') == 'charts'" 
                        wire:navigate>
                        {{ __('Gráficos') }}
                    </x-nav-link>

                    <!-- Enlace Historial -->
                    <x-nav-link 
                        :href="route('dashboard', ['tab' => 'historial'])" 
                        :active="request()->query('tab') == 'historial'" 
                        wire:navigate>
                        {{ __('Historial') }}
                    </x-nav-link>
                    
                    <!-- Enlace Control -->
                    <x-nav-link 
                        :href="route('dashboard', ['tab' => 'control'])" 
                        :active="request()->query('tab') == 'control'" 
                        wire:navigate>
                        {{ __('Control') }}
                    </x-nav-link>

                    <x-nav-link 
                        :href="route('prediccion')" 
                        :active="request()->routeIs('prediccion')" 
                        wire:navigate>
                        {{ __('Predicción IA') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <!-- ================================== -->
                <!-- 1. INTERRUPTOR DE TEMA (ESCRITORIO)  -->
                <!-- ================================== -->
                <button 
                    type="button"
                    x-data="{ 
                        isDark: document.documentElement.classList.contains('dark'),
                        toggle() {
                            this.isDark = !this.isDark;
                            document.documentElement.classList.toggle('dark', this.isDark);
                            localStorage.theme = this.isDark ? 'dark' : 'light';
                        }
                    }"
                    @click="toggle()"
                    class="me-4 p-2 rounded-md text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    aria-label="Toggle dark mode"
                >
                    <!-- Icono de Sol (se muestra si NO es dark) -->
                    <svg x-show="!isDark" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <!-- Icono de Luna (se muestra si SÍ es dark) -->
                    <svg x-show="isDark" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
                <!-- ================================== -->
                <!-- FIN INTERRUPTOR (ESCRITORIO)       -->
                <!-- ================================== -->

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <!-- +++ ESTE ES EL ARREGLO PARA ESCRITORIO +++ -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                        <!-- +++ FIN DEL ARREGLO +++ -->
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (¡Restaurado!) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!-- Enlace Dashboard -->
            <x-responsive-nav-link 
                :href="route('dashboard', ['tab' => 'dashboard'])" 
                :active="request()->query('tab', 'dashboard') == 'dashboard'" 
                wire:navigate>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <!-- Enlace Gráfico -->
            <x-responsive-nav-link 
                :href="route('dashboard', ['tab' => 'charts'])" 
                :active="request()->query('tab') == 'charts'" 
                wire:navigate>
                {{ __('Gráficos') }}
            </x-responsive-nav-link>

            <!-- Enlace Historial -->
            <x-responsive-nav-link 
                :href="route('dashboard', ['tab' => 'historial'])" 
                :active="request()->query('tab') == 'historial'" 
                wire:navigate>
                {{ __('Historial') }}
            </x-responsive-nav-link>

            <!-- Enlace Control -->
            <x-responsive-nav-link 
                :href="route('dashboard', ['tab' => 'control'])" 
                :active="request()->query('tab') == 'control'" 
                wire:navigate>
                {{ __('Control') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link 
                :href="route('prediccion')" 
                :active="request()->routeIs('prediccion')" 
                wire:navigate>
                {{ __('Predicción IA') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">

            <!-- ================================== -->
            <!-- 2. INTERRUPTOR DE TEMA (MÓVIL)       -->
            <!-- ================================== -->
            <div class="px-4 pb-2">
                <button 
                    type="button"
                    x-data="{ 
                        isDark: document.documentElement.classList.contains('dark'),
                        toggle() {
                            this.isDark = !this.isDark;
                            document.documentElement.classList.toggle('dark', this.isDark);
                            localStorage.theme = this.isDark ? 'dark' : 'light';
                        }
                    }"
                    @click="toggle()"
                    class="w-full flex items-center justify-start p-2 rounded-md text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none"
                    aria-label="Toggle dark mode"
                >
                    <!-- Icono de Sol (se muestra si NO es dark) -->
                    <svg x-show="!isDark" class="h-6 w-6 me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <!-- Icono de Luna (se muestra si SÍ es dark) -->
                    <svg x-show="isDark" class="h-6 w-6 me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <!-- Añadimos texto para el menú móvil -->
                    <span x-show="!isDark" class="text-sm font-medium">Cambiar a modo oscuro</span>
                    <span x-show="isDark" class="text-sm font-medium">Cambiar a modo claro</span>
                </button>
            </div>
            <!-- ================================== -->
            <!-- FIN INTERRUPTOR (MÓVIL)            -->
            <!-- ================================== -->

            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <!-- +++ ESTE ES EL ARREGLO PARA MÓVIL (LIMPIADO) +++ -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
                <!-- +++ FIN DEL ARREGLO +++ -->
            </div>
        </div>
    </div>
</nav>