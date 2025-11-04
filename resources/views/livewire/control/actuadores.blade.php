<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">

    <div class="p-6 text-gray-900 dark:text-gray-100">
        <h3 class="text-lg text-center font-semibold mb-6 text-gray-900 dark:text-white">Control de Actuadores</h3>
    </div>

    {{-- SEPARALO PORFAVOR --}}

    <div class="p-6 text-gray-900 dark:text-gray-100">

        {{-- Grid principal de 2 columnas --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6">
                <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2 text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10.5 11.25h3M12 15h.008" />
                    </svg>
                    Alimentador Automático
                </h4>
                
                <div class="flex items-center space-x-4">
                    <!-- Botón para alimentar -->
                    <button 
                        wire:click="feedFish" 
                        wire:loading.attr="disabled"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 disabled:opacity-50">
                        <span wire:loading.remove wire:target="feedFish">
                            Alimentar Peces
                        </span>
                        <span wire:loading wire:target="feedFish">
                            Enviando...
                        </span>
                    </button>

                    @if (session()->has('message'))
                        <div class="text-green-600 dark:text-green-400 font-medium">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-4">
                    Presiona el botón para dispensar una porción de comida. El comando se enviará al ESP32.
                </p>
            </div>

            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6">
                <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2 text-yellow-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v.01M12 6v.01M6 12h.01M18 12h.01M8.025 8.025l.01.01M15.965 15.965l.01.01M8.025 15.965l.01-.01M15.965 8.025l.01-.01" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 21a5.25 5.25 0 005.25-5.25H5.25A5.25 5.25 0 0010.5 21zM10.5 3c2.9 0 5.25 2.35 5.25 5.25h-10.5C5.25 5.35 7.6 3 10.5 3z" />
                    </svg>
                    Control de Iluminación
                </h4>
                
                {{-- Toggle Switch (solo vista) --}}
                <div x-data="{ luzEncendida: false }" class="flex items-center space-x-4">
                    <label for="light-toggle" class="flex items-center cursor-pointer">
                        <div class="relative">
                            <input id="light-toggle" type="checkbox" class="sr-only" x-model="luzEncendida" disabled>
                            {{-- El fondo del toggle --}}
                            <div class="block bg-gray-300 dark:bg-gray-600 w-14 h-8 rounded-full"></div>
                            {{-- El círculo --}}
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
</div>

