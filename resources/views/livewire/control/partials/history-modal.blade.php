{{-- resources/views/livewire/control/partials/history-modal.blade.php --}}

<div 
    x-data="{ show: $wire.entangle('showHistoryModal') }"
    x-show="show"
    x-on:keydown.escape.window="show = false"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 flex items-center justify-center p-4"
    style="display: none;" 
>
    {{-- Fondo oscuro --}}
    <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" 
         @click="show = false"></div>

    {{-- Contenido del Modal --}}
    <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-4xl transition-all flex flex-col"
         @click.outside="show = false"
         x-trap.inert.noscroll="show"
         style="max-height: 80vh;">
        
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Historial de Actividad del Alimentador</h3>
        </div>

        {{-- Filtros --}}
        <div class="p-4 bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
            <label for="logFilter" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filtrar por evento:</label>
            <select id="logFilter" wire:model.live="logFilter" class="mt-1 block w-full sm:w-1/2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                <option value="all">Todos los eventos</option>
                <option value="manual_feed">Alimentación Manual</option>
                <option value="schedule_created">Horarios Creados</option>
                <option value="schedule_toggled">Horarios Activados/Desactivados</option>
                <option value="schedule_deleted">Horarios Eliminados</option>
            </select>
        </div>

        {{-- Contenedor de la Tabla con scroll --}}
        {{-- CAMBIO: Añadido 'overflow-x-auto' para responsividad en móviles --}}
        <div class="flex-grow overflow-y-auto overflow-x-auto custom-scrollbar relative">
            
            {{-- Spinner de Carga --}}
            <div wire:loading.flex wire:target="logFilter" class="absolute inset-0 items-center justify-center bg-white/50 dark:bg-gray-800/50 z-10">
                <div class="flex items-center justify-center text-gray-500 dark:text-gray-400 p-10">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Cargando historial...</span>
                </div>
            </div>

            {{-- Contenedor de la Tabla --}}
            <div class="align-middle inline-block min-w-full" wire:loading.remove wire:target="logFilter">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    {{-- Encabezado Fijo (Sticky) --}}
                    <thead class="bg-gray-50 dark:bg-gray-700/50 sticky top-0 z-5">
                        {{-- CAMBIO: Nueva estructura de columnas --}}
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Evento
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Estado
                            </th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Porciones
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Fecha y Hora
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($logs as $log)
                            @php
                                // Obtenemos los colores y estados de las funciones helper
                                $statusText = $this->getLogStatus($log);
                                $statusColor = $this->getLogStatusColor($log);
                                $colorClasses = [
                                    'green' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                    'blue' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                    'red' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                    'gray' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                ];
                            @endphp
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                
                                {{-- Columna 1: Evento (Icono + Título) --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-gray-100 dark:bg-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-500 dark:text-gray-400">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $this->getLogIcon($log->event_type) }}" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $this->getLogTitle($log->event_type) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                
                                {{-- Columna 2: Estado (¡NUEVA!) --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colorClasses[$statusColor] ?? $colorClasses['gray'] }}">
                                        {{ $statusText }}
                                    </span>
                                </td>

                                {{-- Columna 3: Porciones --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $this->getLogPortions($log) }}
                                    </span>
                                </td>
                                
                                {{-- Columna 4: Fecha y Hora --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    <div class="font-medium">{{ $log->created_at->format('d/m/Y') }}</div>
                                    <div class="text-xs">{{ $log->created_at->format('h:i:s A') }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                {{-- Estado vacío --}}
                                <td colspan="4">
                                    <div class="text-center text-gray-500 dark:text-gray-400 py-10 px-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto text-gray-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                        </svg>
                                        <p class="mt-2 font-semibold">No hay eventos</p>
                                        <p class="text-sm">No se encontraron registros para el filtro seleccionado.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- Paginación (Se muestra solo si hay logs) --}}
        @if ($logs->hasPages())
            <div class="p-4 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-200 dark:border-gray-700">
                {{ $logs->links() }}
            </div>
        @endif
        
        {{-- Footer con botón de cerrar --}}
        <div class="bg-gray-100 dark:bg-gray-800 px-6 py-4 flex justify-end border-t border-gray-200 dark:border-gray-700">
            <button type="button" 
                    @click="show = false"
                    class="px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cerrar
            </button>
        </div>

    </div>
</div>