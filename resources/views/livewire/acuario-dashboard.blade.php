{{-- 👇 AQUÍ ESTÁ EL CAMBIO: Usamos bg-transparent --}}
<div class="bg-transparent py-12" >
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- 1. Verificamos si hay datos --}}
        @if ($lecturaActual)

            {{-- 2. Mostramos el componente hijo basado en la pestaña activa --}}
            @if ($activeTab == 'dashboard')
                <livewire:dashboard.stats :lectura="$lecturaActual" wire:key="dashboard-stats" />

            @elseif ($activeTab == 'control')
                <livewire:control.actuadores wire:key="control-actuadores" />
            
            @elseif ($activeTab == 'charts')
                <livewire:control.graficos wire:key="control-graficos" />

            @elseif ($activeTab == 'historial')
                <livewire:control.historial wire:key="control-historial" lazy />
            @endif

        {{-- 3. Mensaje si no hay NINGÚN dato en la BD --}}
        @else
            {{-- Nota: Esta caja de "No hay datos" seguirá siendo blanca. Si quieres que también sea transparente, cambia bg-white por bg-white/80 o bg-transparent aquí abajo --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-12 text-gray-900 dark:text-gray-100 text-center">
                    <svg class="h-16 w-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h15.75c.621 0 1.125.504 1.125 1.125v6.75c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 013 19.875v-6.75zM3 8.625c0-.621.504-1.125 1.125-1.125h15.75c.621 0 1.125.504 1.125 1.125v3.375c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 013 12V8.625zM3 4.125C3 3.504 3.504 3 4.125 3h15.75c.621 0 1.125.504 1.125 1.125v3.375c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 013 7.5V4.125z" />
                    </svg>
                    <p class="text-xl font-semibold text-gray-700 dark:text-gray-200">Aún no hay datos.</p>
                    <p class="text-gray-500 dark:text-gray-400 mt-2">Esperando la primera lectura de los sensores...</p>
                </div>
            </div>
        @endif

    </div>
</div>