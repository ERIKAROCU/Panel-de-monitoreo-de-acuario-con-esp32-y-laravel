<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">

    <div class="p-6 text-gray-900 dark:text-gray-100">
        <h3 class="text-lg text-center font-semibold mb-6 text-gray-900 dark:text-white">Control de Actuadores</h3>
        {{-- Grid principal de 2 columnas --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- =================================== --}}
            {{-- COLUMNA 1: ALIMENTADOR DE PECES      --}}
            {{-- =================================== --}}
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 flex flex-col">
                <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2 text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10.5 11.25h3M12 15h.008" />
                    </svg>
                    Alimentador Automático
                </h4>
                
                {{-- Botones de Acción --}}
                <div class="flex items-center space-x-4">
                    <button 
                        wire:click="feedFish" 
                        wire:loading.attr="disabled"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 disabled:opacity-50">
                        <span wire:loading.remove wire:target="feedFish">
                            Alimentar (1 Vez)
                        </span>
                        <span wire:loading wire:target="feedFish">
                            Enviando...
                        </span>
                    </button>
                    <button 
                        wire:click="openScheduleModal"
                        class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-bold rounded-lg shadow-md transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                        Programar
                    </button>
                </div>

                @if (session()->has('message_feed'))
                    <div class="text-green-600 dark:text-green-400 font-medium mt-3">
                        {{ session('message_feed') }}
                    </div>
                @endif
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-4">
                    Presiona "Alimentar" para dispensar una porción ahora, o "Programar" para crear un horario.
                </p>

                {{-- Lista de Horarios Programados --}}
                <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700 flex-grow">
                    <h5 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Horarios Activos</h5>
                    @if (session()->has('message_schedule'))
                        <div class="text-green-600 dark:text-green-400 font-medium mb-3 text-sm">
                            {{ session('message_schedule') }}
                        </div>
                    @endif

                    <div class="max-h-60 overflow-y-auto pr-2 custom-scrollbar">
                    <div class="space-y-3">
                        @forelse ($schedules as $schedule)
                            <div @class(['opacity-50' => !$schedule->is_active])>
                                <div class="flex justify-between items-center bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                                    
                                    {{-- Interruptor --}}
                                    <button 
                                        wire:click="toggleSchedule({{ $schedule->id }})" 
                                        class="relative inline-flex items-center h-6 rounded-full w-11 transition-colors {{ $schedule->is_active ? 'bg-indigo-600' : 'bg-gray-400' }}">
                                        <span class="inline-block w-4 h-4 transform bg-white rounded-full transition-transform {{ $schedule->is_active ? 'translate-x-6' : 'translate-x-1' }}"></span>
                                    </button>

                                    <div class="flex items-center space-x-3">
                                        <span class="font-bold text-gray-900 dark:text-gray-100 text-lg">{{ $schedule->time->format('h:i A') }}</span>
                                        <div class="text-sm text-gray-600 dark:text-gray-300">
                                            <p>{{ $schedule->portions }} {{ $schedule->portions > 1 ? 'porciones' : 'porción' }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ collect($schedule->days)->map(fn($day) => ucfirst(substr($day, 0, 2)))->implode(', ') }}</p>
                                        </div>
                                    </div>

                                    <button wire:click="deleteSchedule({{ $schedule->id }})" wire:loading.attr="disabled" class="text-red-500 hover:text-red-700 disabled:opacity-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12.54 0c.342.052.682.107 1.022.166m11.518 0l-2.993-2.993m-12.54 0l2.993 2.993m0 0l-2.993 2.993m2.993-2.993l2.993 2.993" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">No hay horarios programados.</p>
                        @endforelse
                    </div>
                    </div>
                </div>
            </div>

            {{-- =================================== --}}
            {{-- COLUMNA 2: CONTROL DE ILUMINACIÓN --}}
            {{-- =================================== --}}
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6">
                <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2 text-yellow-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v.01M12 6v.01M6 12h.01M18 12h.01M8.025 8.025l.01.01M15.965 15.965l.01.01M8.025 15.965l.01-.01M15.965 8.025l.01-.01" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 21a5.25 5.25 0 005.25-5.25H5.25A5.25 5.25 0 0010.5 21zM10.5 3c2.9 0 5.25 2.35 5.25 5.25h-10.5C5.25 5.35 7.6 3 10.5 3z" />
                    </svg>
                    Control de Iluminación
                </h4>
                
                <div x-data="{ luzEncendida: false }" class="flex items-center space-x-4">
                    <label for="light-toggle" class="flex items-center cursor-not-allowed opacity-50">
                        <div class="relative">
                            <input id="light-toggle" type="checkbox" class="sr-only" x-model="luzEncendida" disabled>
                            <div class="block bg-gray-300 dark:bg-gray-600 w-14 h-8 rounded-full"></div>
                            <div class="dot absolute left-1 top-1 bg-white dark:bg-gray-900 w-6 h-6 rounded-full transition-transform"
                                 :class="{ 'translate-x-6 !bg-yellow-400': luzEncendida }"></div>
                        </div>
                        <div class="ml-3 font-medium text-gray-700 dark:text-gray-300"
                             x-text="luzEncendida ? 'Luz Encendida' : 'Luz Apagada'">
                            Luz Apagada
                        </div>
                    </label>
                </div>
                 <p class="text-sm text-gray-500 dark:text-gray-400 mt-4">
                    (Próximamente) Mueve el interruptor para encender o apagar la iluminación del acuario.
                 </p>
            </div>

        </div>
    </div>

    @include('livewire.control.partials.schedule-modal')

</div>

