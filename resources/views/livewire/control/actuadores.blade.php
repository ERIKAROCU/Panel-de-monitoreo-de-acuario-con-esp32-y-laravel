<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">

    <div class="p-6 text-gray-900 dark:text-gray-100">
        <h3 class="text-xl text-center font-bold mb-8 text-gray-800 dark:text-white tracking-wide">
            Control de Acuario Inteligente
        </h3>
        
        {{-- Grid principal de 2 columnas --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- =================================== --}}
            {{-- COLUMNA 1: ALIMENTADOR DE PECES      --}}
            {{-- =================================== --}}
            <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-6 flex flex-col bg-gray-50/50 dark:bg-gray-800/50 relative group hover:border-blue-300 dark:hover:border-blue-700 transition-colors duration-300">
                
                {{-- ENCABEZADO DE TARJETA (Título + Configuración) --}}
                <div class="flex justify-between items-start mb-6">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 flex items-center">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-600 dark:text-blue-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10.5 11.25h3M12 15h.008" />
                            </svg>
                        </div>
                        Alimentador
                    </h4>

                    {{-- Botón Configuración (Tuerca) - Ubicado estratégicamente arriba a la derecha --}}
                    <button 
                        wire:click="$set('showConfigModal', true)" 
                        class="text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all transform hover:rotate-90 p-1 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700"
                        title="Calibrar Motor"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                </div>
                
                {{-- ACCIONES PRINCIPALES --}}
                <div class="space-y-4">
                    
                    {{-- 1. Botón Principal: ALIMENTAR (Destacado) --}}
                    <button 
                        wire:click="feedFish" 
                        wire:loading.attr="disabled"
                        class="w-full relative group overflow-hidden px-6 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold rounded-xl shadow-lg transition-all duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <div class="flex items-center justify-center gap-3">
                            {{-- Icono Comida --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 animate-pulse">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10.5 11.25h3M12 15h.008" />
                            </svg>
                            <span wire:loading.remove wire:target="feedFish" class="text-lg">Alimentar Ahora</span>
                            <span wire:loading wire:target="feedFish" class="text-lg">Enviando...</span>
                        </div>
                    </button>

                    @if (session()->has('message_feed'))
                        <div class="bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-2 rounded-lg text-sm text-center font-medium animate-fade-in-up">
                            {{ session('message_feed') }}
                        </div>
                    @endif

                    {{-- 2. Botones Secundarios: GRID --}}
                    <div class="grid grid-cols-2 gap-4 mt-2">
                        {{-- Botón Programar --}}
                        <button 
                            wire:click="openScheduleModal"
                            class="flex flex-col items-center justify-center p-3 bg-white dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 hover:border-blue-400 dark:hover:border-blue-500 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-all duration-200 shadow-sm hover:shadow-md"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mb-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="font-semibold text-sm">Programar</span>
                        </button>

                        {{-- Botón Historial --}}
                        <button 
                            wire:click="openHistoryModal"
                            class="flex flex-col items-center justify-center p-3 bg-white dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 hover:border-purple-400 dark:hover:border-purple-500 rounded-xl text-gray-600 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400 transition-all duration-200 shadow-sm hover:shadow-md"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mb-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            <span class="font-semibold text-sm">Historial</span>
                        </button>
                    </div>
                </div>

                {{-- Lista de Horarios Programados --}}
                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex-grow">
                    <div class="flex justify-between items-center mb-4">
                        <h5 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Próximos Horarios</h5>
                        @if($schedules->isNotEmpty())
                            <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs font-bold px-2 py-0.5 rounded-full">{{ $schedules->count() }}</span>
                        @endif
                    </div>

                    @if (session()->has('message_schedule'))
                        <div class="text-green-600 dark:text-green-400 font-medium mb-3 text-sm animate-pulse">
                            {{ session('message_schedule') }}
                        </div>
                    @endif

                    <div class="max-h-60 overflow-y-auto pr-2 custom-scrollbar">
                        <div class="space-y-3">
                            @forelse ($schedules as $schedule)
                                <div class="group relative bg-white dark:bg-gray-700 rounded-lg p-3 border border-gray-100 dark:border-gray-600 shadow-sm hover:shadow-md transition-all duration-200 {{ !$schedule->is_active ? 'opacity-60 grayscale' : '' }}">
                                    <div class="flex justify-between items-center">
                                        
                                        <div class="flex items-center space-x-3">
                                            {{-- Interruptor pequeño --}}
                                            <button 
                                                wire:click="toggleSchedule({{ $schedule->id }})" 
                                                class="relative inline-flex items-center h-5 rounded-full w-9 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 {{ $schedule->is_active ? 'bg-blue-500' : 'bg-gray-300 dark:bg-gray-500' }}">
                                                <span class="inline-block w-3 h-3 transform bg-white rounded-full transition-transform {{ $schedule->is_active ? 'translate-x-5' : 'translate-x-1' }}"></span>
                                            </button>

                                            <div>
                                                <div class="font-bold text-gray-800 dark:text-gray-100 text-lg leading-none">
                                                    {{ $schedule->time->format('h:i') }} <span class="text-xs text-gray-500">{{ $schedule->time->format('A') }}</span>
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                    {{ $schedule->portions }} porción(es) • {{ collect($schedule->days)->map(fn($day) => ucfirst(substr($day, 0, 2)))->implode(', ') }}
                                                </div>
                                            </div>
                                        </div>

                                        <button wire:click="deleteSchedule({{ $schedule->id }})" wire:loading.attr="disabled" class="text-gray-300 hover:text-red-500 transition-colors p-1 rounded-md hover:bg-red-50 dark:hover:bg-red-900/20">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12.54 0c.342.052.682.107 1.022.166m11.518 0l-2.993-2.993m-12.54 0l2.993 2.993m0 0l-2.993 2.993m2.993-2.993l2.993 2.993" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-6 border-2 border-dashed border-gray-200 dark:border-gray-600 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mx-auto text-gray-300 dark:text-gray-600 mb-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">No hay horarios programados.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- =================================== --}}
            {{-- COLUMNA 2: CONTROL DE ILUMINACIÓN --}}
            {{-- =================================== --}}
            <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-6 bg-gray-50/50 dark:bg-gray-800/50 hover:border-yellow-300 dark:hover:border-yellow-700 transition-colors duration-300">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-6 flex items-center">
                    <div class="p-2 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-yellow-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v.01M12 6v.01M6 12h.01M18 12h.01M8.025 8.025l.01.01M15.965 15.965l.01.01M8.025 15.965l.01-.01M15.965 8.025l.01-.01" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 21a5.25 5.25 0 005.25-5.25H5.25A5.25 5.25 0 0010.5 21zM10.5 3c2.9 0 5.25 2.35 5.25 5.25h-10.5C5.25 5.35 7.6 3 10.5 3z" />
                        </svg>
                    </div>
                    Control de Iluminación
                </h4>
                
                <div x-data="{ luzEncendida: false }" class="flex items-center space-x-4 mb-4">
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
                <div class="bg-yellow-50 dark:bg-yellow-900/10 border border-yellow-100 dark:border-yellow-900/30 rounded-lg p-4">
                    <p class="text-sm text-yellow-700 dark:text-yellow-500 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        Módulo en desarrollo. Próximamente podrás controlar las luces desde aquí.
                    </p>
                </div>
            </div>

        </div>
    </div>

    {{-- INCLUDES DE LOS MODALES AL FINAL --}}
    @include('livewire.control.partials.schedule-modal')
    @include('livewire.control.partials.history-modal')
    @include('livewire.control.partials.config-modal')

</div>