<div 
    x-data="{ show: $wire.entangle('showConfigModal') }"
    x-show="show"
    x-on:keydown.escape.window="show = false"
    class="fixed inset-0 z-50 flex items-center justify-center p-4"
    style="display: none;" 
>
    {{-- Fondo oscuro --}}
    <div 
        x-show="show" 
        x-transition.opacity
        class="fixed inset-0 bg-gray-900 bg-opacity-75" 
        @click="show = false"
    ></div>

    {{-- Contenido del Modal --}}
    <div 
        x-show="show" 
        x-transition.scale
        class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md"
        @click.outside="show = false"
    >
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-indigo-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                </svg>
                Configuración de Lectura (ESP32)
            </h3>
            
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                Controla cómo y cuándo el ESP32 envía datos al servidor.
            </p>

            <div class="space-y-6">
                
                {{-- 1. SWITCH: PAUSAR LECTURAS --}}
                <div class="flex items-center justify-between">
                    <div>
                        <label class="font-medium text-gray-700 dark:text-gray-200">Estado de Lectura</label>
                        <p class="text-xs text-gray-500">Si se desactiva, no se registrarán datos.</p>
                    </div>
                    
                    <button 
                        type="button" 
                        wire:click="$toggle('sensorPaused')"
                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 {{ !$sensorPaused ? 'bg-green-500' : 'bg-gray-200 dark:bg-gray-700' }}"
                    >
                        <span class="sr-only">Toggle setting</span>
                        <span 
                            class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ !$sensorPaused ? 'translate-x-5' : 'translate-x-0' }}"
                        ></span>
                    </button>
                    <span class="ml-2 text-sm font-bold {{ !$sensorPaused ? 'text-green-600' : 'text-gray-500' }}">
                        {{ !$sensorPaused ? 'ACTIVO' : 'PAUSADO' }}
                    </span>
                </div>

                {{-- 2. INPUT: INTERVALO DE TIEMPO --}}
                <div class="{{ $sensorPaused ? 'opacity-50 pointer-events-none' : '' }} transition-opacity">
                    <label class="block font-medium text-gray-700 dark:text-gray-200 mb-2">
                        Intervalo de envío (segundos)
                    </label>
                    <div class="flex items-center gap-2">
                        <input 
                            type="number" 
                            wire:model="sensorInterval"
                            min="5" 
                            max="3600"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm"
                        >
                        <span class="text-gray-500 dark:text-gray-400 text-sm">seg</span>
                    </div>
                    @error('sensorInterval') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    
                    {{-- Sugerencias rápidas --}}
                    <div class="flex gap-2 mt-2">
                        <button type="button" wire:click="$set('sensorInterval', 10)" class="text-xs px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded hover:bg-gray-200 dark:hover:bg-gray-600">10s</button>
                        <button type="button" wire:click="$set('sensorInterval', 60)" class="text-xs px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded hover:bg-gray-200 dark:hover:bg-gray-600">1m</button>
                        <button type="button" wire:click="$set('sensorInterval', 300)" class="text-xs px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded hover:bg-gray-200 dark:hover:bg-gray-600">5m</button>
                        <button type="button" wire:click="$set('sensorInterval', 1800)" class="text-xs px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded hover:bg-gray-200 dark:hover:bg-gray-600">30m</button>
                    </div>
                </div>

            </div>
        </div>

        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 flex justify-end gap-3 rounded-b-lg">
            <button 
                type="button" 
                @click="show = false"
                class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600"
            >
                Cancelar
            </button>
            <button 
                type="button" 
                wire:click="saveSettings"
                wire:loading.attr="disabled"
                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md shadow-sm text-sm font-medium focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Guardar Cambios
            </button>
        </div>
    </div>
</div>