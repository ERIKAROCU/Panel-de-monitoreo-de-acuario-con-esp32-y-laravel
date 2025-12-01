{{-- =================================== --}}
{{-- MODAL PARA PROGRAMAR ALIMENTADOR --}}
{{-- =================================== --}}

<div 
    x-data="{ show: $wire.entangle('showScheduleModal') }"
    x-show="show"
    x-on:keydown.escape.window="show = fals.e"
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
         class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-lg transition-all"
         @click.outside="show = false"
         x-trap.inert.noscroll="show">
        
        <form wire:submit.prevent="saveSchedule">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Programar Alimentación</h3>
                
                <div class="mt-6 space-y-4">
                    {{-- HORA --}}
                    <div>
                        <label for="time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hora (Formato 24h)</label>
                        <input id="time" type="time" wire:model="newScheduleTime" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                        @error('newScheduleTime') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- PORCIONES --}}
                    <div>
                        <label for="portions" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Porciones (1-5)</label>
                        <input id="portions" type="number" wire:model="newSchedulePortions" min="1" max="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                        @error('newSchedulePortions') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- DÍAS DE LA SEMANA --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Días de la semana</label>
                        <div class="mt-2 grid grid-cols-4 sm:grid-cols-7 gap-2">
                            @foreach(['lunes' => 'Lu', 'martes' => 'Ma', 'miercoles' => 'Mi', 'jueves' => 'Ju', 'viernes' => 'Vi', 'sabado' => 'Sá', 'domingo' => 'Do'] as $dayValue => $dayLabel)
                                <label for="day-{{ $dayValue }}" class="flex flex-col items-center p-2 border border-gray-300 dark:border-gray-600 rounded-md cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $dayLabel }}</span>
                                    <input type="checkbox" id="day-{{ $dayValue }}" value="{{ $dayValue }}" wire:model="newScheduleDays" class="mt-1 h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                </label>
                            @endforeach
                        </div>
                        @error('newScheduleDays') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- --- ¡NUEVO BLOQUE! --- --}}
                    <div>
                        <label for="is_active" class="flex items-center space-x-3 cursor-pointer">
                            <input id="is_active" type="checkbox" wire:model="newScheduleIsActive" class="h-5 w-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Activar este horario inmediatamente</span>
                        </label>
                    </div>

                </div>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 flex justify-end space-x-3">
                <button type="button" 
                        @click="show = false"
                        class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancelar
                </button>
                <button type="submit" 
                        wire:loading.attr="disabled"
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 border border-transparent rounded-md shadow-sm text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50">
                    <span wire:loading.remove wire:target="saveSchedule">
                        Guardar Horario
                    </span>
                    <span wire:loading wire:target="saveSchedule">
                        Guardando...
                    </span>
                </button>
            </div>
        </form>

    </div>
</div>

