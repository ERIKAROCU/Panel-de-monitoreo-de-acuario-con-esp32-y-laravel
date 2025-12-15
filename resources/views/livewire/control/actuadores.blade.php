<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">

    <div class="p-6 text-gray-900 dark:text-gray-100">
        <h3 class="text-xl text-center font-bold mb-8 text-gray-800 dark:text-white tracking-wide">
            Control de Acuario Inteligente
        </h3>
        
        {{-- LAYOUT PRINCIPAL: GRID DE 2 COLUMNAS --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- ============================================================== --}}
            {{-- COLUMNA IZQUIERDA: BOTONES DEL CONTROLADOR (ALIMENTADOR)       --}}
            {{-- ============================================================== --}}
            <div class="h-full border border-gray-200 dark:border-gray-700 rounded-xl p-8 flex flex-col justify-center bg-gray-50/50 dark:bg-gray-800/50 relative group hover:border-blue-300 dark:hover:border-blue-700 transition-colors duration-300">
                
                {{-- ENCABEZADO: Título y Configuración --}}
                <div class="flex justify-between items-start mb-8">
                    <h4 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center">
                        <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-xl mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-blue-600 dark:text-blue-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10.5 11.25h3M12 15h.008" />
                            </svg>
                        </div>
                        <div>
                            <span class="block">Panel de Control</span>
                            <span class="text-sm font-normal text-gray-500">Alimentador</span>
                        </div>
                    </h4>

                    {{-- Botón Tuerca --}}
                    <button 
                        wire:click="$set('showConfigModal', true)" 
                        class="text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all transform hover:rotate-90 p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700"
                        title="Calibrar Motor"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                </div>
                {{-- AÑADIDO: Imagen del Pez/Alimentador --}}
                <div class="w-full flex justify-center mb-6">
                    <img src="{{ asset('images/nemo.gif') }}" 
                        alt="Animación Alimentador" 
                        class="h-50 w-auto mx-auto hover:scale-105 transition-transform duration-500 ease-in-out rounded-lg shadow-md">
                </div>

                {{-- ACCIONES DE CONTROL (BOTONES GRANDES) --}}
                <div class="space-y-6 flex-grow flex flex-col justify-center">
                    
                    {{-- 1. BOTÓN ALIMENTAR --}}
                    <button 
                        wire:click="feedFish" 
                        wire:loading.attr="disabled"
                        class="w-full relative group overflow-hidden px-6 py-6 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold rounded-2xl shadow-xl transition-all duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <div class="flex flex-col items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10 animate-bounce">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10.5 11.25h3M12 15h.008" />
                            </svg>
                            <span wire:loading.remove wire:target="feedFish" class="text-2xl tracking-wide">ALIMENTAR</span>
                            <span wire:loading wire:target="feedFish" class="text-xl">Enviando...</span>
                        </div>
                    </button>

                    {{-- Feedback Message --}}
                    @if (session()->has('message_feed'))
                        <div class="bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg text-center font-bold animate-fade-in-up">
                            {{ session('message_feed') }}
                        </div>
                    @endif

                    {{-- 2. GRID DE BOTONES SECUNDARIOS --}}
                    <div class="grid grid-cols-2 gap-4">
                        {{-- Botón Programar --}}
                        <button 
                            wire:click="openScheduleModal"
                            class="flex flex-col items-center justify-center p-4 bg-white dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 hover:border-blue-400 dark:hover:border-blue-500 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-all duration-200 shadow-sm hover:shadow-md h-32"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mb-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="font-bold">Nuevo Horario</span>
                        </button>

                        {{-- Botón Historial --}}
                        <button 
                            wire:click="openHistoryModal"
                            class="flex flex-col items-center justify-center p-4 bg-white dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 hover:border-purple-400 dark:hover:border-purple-500 rounded-xl text-gray-600 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400 transition-all duration-200 shadow-sm hover:shadow-md h-32"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mb-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            <span class="font-bold">Ver Historial</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- ============================================================== --}}
            {{-- COLUMNA DERECHA: WRAPPER PARA HORARIOS (ARRIBA) Y LUZ (ABAJO)  --}}
            {{-- ============================================================== --}}
            <div class="flex flex-col gap-6 h-full">

                {{-- BLOQUE 1: HORARIOS PROGRAMADOS (Ocupa el espacio restante disponible) --}}
                <div class="flex-grow border border-gray-200 dark:border-gray-700 rounded-xl p-6 bg-white dark:bg-gray-800 relative shadow-sm">
                    <div class="flex justify-between items-center mb-6 border-b border-gray-100 dark:border-gray-700 pb-4">
                        <h4 class="text-lg font-bold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                            Horarios Programados
                        </h4>
                        @if($schedules->isNotEmpty())
                            <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs font-bold px-3 py-1 rounded-full shadow-sm">{{ $schedules->count() }} Activos</span>
                        @endif
                    </div>

                    @if (session()->has('message_schedule'))
                        <div class="text-green-600 dark:text-green-400 font-medium mb-3 text-sm animate-pulse text-center">
                            {{ session('message_schedule') }}
                        </div>
                    @endif

                    {{-- Lista Scrollable con altura máxima para que no rompa el diseño --}}
                    <div class="overflow-y-auto pr-2 custom-scrollbar h-[300px] lg:h-auto lg:max-h-[400px]">
                        <div class="space-y-3">
                            @forelse ($schedules as $schedule)
                                <div class="group relative bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 border border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-500 transition-all duration-200 {{ !$schedule->is_active ? 'opacity-60 grayscale' : '' }}">
                                    <div class="flex justify-between items-center">
                                        
                                        <div class="flex items-center space-x-4">
                                            {{-- Interruptor pequeño --}}
                                            <button 
                                                wire:click="toggleSchedule({{ $schedule->id }})" 
                                                class="relative inline-flex items-center h-5 rounded-full w-9 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 {{ $schedule->is_active ? 'bg-blue-500' : 'bg-gray-300 dark:bg-gray-500' }}">
                                                <span class="inline-block w-3 h-3 transform bg-white rounded-full transition-transform {{ $schedule->is_active ? 'translate-x-5' : 'translate-x-1' }}"></span>
                                            </button>

                                            <div>
                                                <div class="font-bold text-gray-800 dark:text-gray-100 text-xl leading-none">
                                                    {{ $schedule->time->format('H:i') }}
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1 flex items-center gap-1">
                                                    <span class="font-semibold">{{ $schedule->portions }} Porción(es)</span>
                                                    <span>•</span>
                                                    <span>{{ collect($schedule->days)->map(fn($day) => ucfirst(substr($day, 0, 2)))->implode(', ') }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <button wire:click="deleteSchedule({{ $schedule->id }})" wire:loading.attr="disabled" class="text-gray-300 hover:text-red-500 transition-colors p-2 rounded-full hover:bg-white dark:hover:bg-gray-800 shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12.54 0c.342.052.682.107 1.022.166m11.518 0l-2.993-2.993m-12.54 0l2.993 2.993m0 0l-2.993 2.993m2.993-2.993l2.993 2.993" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-10 flex flex-col items-center justify-center opacity-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-gray-400 mb-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-gray-500 dark:text-gray-400 font-medium">Sin horarios</p>
                                    <p class="text-xs text-gray-400">Usa el botón "Nuevo Horario"</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- BLOQUE 2: CONTROL DE ILUMINACIÓN (Abajo) --}}
                <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-6 bg-white dark:bg-gray-800 hover:border-yellow-300 dark:hover:border-yellow-700 transition-colors duration-300 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-yellow-600 dark:text-yellow-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v.01M12 6v.01M6 12h.01M18 12h.01M8.025 8.025l.01.01M15.965 15.965l.01.01M8.025 15.965l.01-.01M15.965 8.025l.01-.01" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 21a5.25 5.25 0 005.25-5.25H5.25A5.25 5.25 0 0010.5 21zM10.5 3c2.9 0 5.25 2.35 5.25 5.25h-10.5C5.25 5.35 7.6 3 10.5 3z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-800 dark:text-gray-200">Iluminación</h4>
                                <p class="text-xs text-gray-500">{{ $luzEncendida ? 'Estado actual: ON' : 'Estado actual: OFF' }}</p>
                            </div>
                        </div>

                        {{-- Interruptor Grande de Luz --}}
                        <label for="light-toggle" class="flex items-center cursor-pointer relative">
                            <input id="light-toggle" type="checkbox" class="sr-only" 
                                wire:click="toggleLight" 
                                @checked($luzEncendida)>
                            
                            <div class="block bg-gray-200 dark:bg-gray-700 w-16 h-9 rounded-full shadow-inner transition-colors {{ $luzEncendida ? '!bg-yellow-100' : '' }}"></div>
                            <div class="dot absolute left-1 top-1 w-7 h-7 rounded-full transition-transform duration-300 shadow-md flex items-center justify-center {{ $luzEncendida ? 'translate-x-7 bg-yellow-400' : 'bg-white' }}">
                                @if($luzEncendida)
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-white">
                                        <path d="M11.983 1.907a.75.75 0 00-1.292-.657l-8.5 9.5A.75.75 0 002.75 12h6.572l-1.283 6.093a.75.75 0 001.292.657l8.5-9.5A.75.75 0 0017.25 8h-6.572l1.305-6.093z" />
                                    </svg>
                                @endif
                            </div>
                        </label>
                    </div>
                </div>

            </div> {{-- Fin Columna Derecha --}}

        </div> {{-- Fin Grid Principal --}}
    </div>

    {{-- INCLUDES DE LOS MODALES --}}
    @include('livewire.control.partials.schedule-modal')
    @include('livewire.control.partials.history-modal')
    @include('livewire.control.partials.config-modal')

</div>