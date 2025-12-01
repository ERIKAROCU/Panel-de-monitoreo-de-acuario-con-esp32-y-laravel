<div class="space-y-8">

    {{-- =========================================== --}}
    {{-- SECCIÓN 1: MONITOR DE SENSORES (AHORA vs FUTURO) --}}
    {{-- =========================================== --}}
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
        <div class="p-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                <div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white tracking-wide flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Monitor de Predicciones en Tiempo Real
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Comparativa: Estado Actual vs Proyección IA</p>
                </div>

                {{-- BOTÓN REFRESH --}}
                <button wire:click="actualizarProyecciones" wire:loading.attr="disabled" 
                    class="group flex items-center gap-2 px-5 py-2.5 bg-gray-50 dark:bg-gray-700 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 text-gray-700 dark:text-gray-200 rounded-xl border border-gray-200 dark:border-gray-600 hover:border-indigo-300 dark:hover:border-indigo-500 transition-all duration-300 shadow-sm">
                    <svg wire:loading.remove class="w-5 h-5 text-gray-400 group-hover:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <svg wire:loading class="animate-spin w-5 h-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="font-semibold text-sm">Actualizar Análisis</span>
                </button>
            </div>

            @if(isset($proyecciones['error']))
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                    <span class="font-medium">Error:</span> {{ $proyecciones['error'] }}
                </div>
            @elseif($ultimoRegistro && $proyecciones)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    
                    {{-- 1. TEMPERATURA AGUA --}}
                    @include('livewire.prediccion.partials.sensor-card', [
                        'title' => 'Temp. Agua',
                        'icon' => '<svg class="w-6 h-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>',
                        'color' => 'blue',
                        'current' => $ultimoRegistro->temp_agua,
                        'unit' => '°C',
                        'forecast' => $proyecciones['proyecciones']['temperatura_agua'] ?? null
                    ])

                    {{-- 2. TEMPERATURA AMBIENTE --}}
                    @include('livewire.prediccion.partials.sensor-card', [
                        'title' => 'Temp. Ambiente',
                        'icon' => '<svg class="w-6 h-6 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>',
                        'color' => 'orange',
                        'current' => $ultimoRegistro->temp_ambiente,
                        'unit' => '°C',
                        'forecast' => $proyecciones['proyecciones']['temperatura_ambiente'] ?? null
                    ])

                    {{-- 3. HUMEDAD --}}
                    @include('livewire.prediccion.partials.sensor-card', [
                        'title' => 'Humedad',
                        'icon' => '<svg class="w-6 h-6 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" /></svg>',
                        'color' => 'teal',
                        'current' => $ultimoRegistro->humedad,
                        'unit' => '%',
                        'forecast' => $proyecciones['proyecciones']['humedad'] ?? null
                    ])

                    {{-- 4. CALIDAD (TDS) --}}
                    @include('livewire.prediccion.partials.sensor-card', [
                        'title' => 'Calidad (TDS)',
                        'icon' => '<svg class="w-6 h-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
                        'color' => 'yellow',
                        'current' => $ultimoRegistro->tds,
                        'unit' => 'ppm',
                        'forecast' => $proyecciones['proyecciones']['tds'] ?? null
                    ])

                </div>
            @else
                <div class="text-center py-10 opacity-50">
                    <div class="animate-pulse">Cargando datos...</div>
                </div>
            @endif
        </div>
    </div>


    {{-- =========================================== --}}
    {{-- SECCIÓN 2: HERRAMIENTAS (SIMULADOR Y MÉTRICAS) --}}
    {{-- =========================================== --}}
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
        <div class="p-6">
             <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                {{-- COLUMNA 1: SIMULADOR MANUAL --}}
                <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-6 flex flex-col bg-gray-50/50 dark:bg-gray-800/50 relative group hover:border-indigo-300 dark:hover:border-indigo-700 transition-colors duration-300">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-6 flex items-center">
                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-indigo-600 dark:text-indigo-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
                            </svg>
                        </div>
                        Simulador "Qué pasaría si..."
                    </h4>

                    <form wire:submit.prevent="predecir" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Temp. Ambiente (°C)</label>
                            <input type="number" step="0.1" wire:model="temperatura" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white" placeholder="Ej: 25.5">
                            @error('temperatura') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" wire:loading.attr="disabled"
                            class="w-full relative px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold rounded-xl shadow-lg transition-all transform hover:scale-[1.02]">
                            <span wire:loading.remove>Simular</span>
                            <span wire:loading>Procesando...</span>
                        </button>
                    </form>

                    @if($resultado)
                        <div class="mt-4 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg text-center animate-fade-in-up">
                            <p class="text-xs text-green-600 uppercase font-bold">Humedad Estimada</p>
                            <p class="text-3xl font-extrabold text-green-700 dark:text-green-300">{{ $resultado }}%</p>
                        </div>
                    @endif
                </div>

                {{-- COLUMNA 2: MÉTRICAS DEL MODELO --}}
                <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-6 bg-gray-50/50 dark:bg-gray-800/50 hover:border-blue-300 dark:hover:border-blue-700 transition-colors duration-300">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-6 flex items-center">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-600 dark:text-blue-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                            </svg>
                        </div>
                        Salud del Modelo IA
                    </h4>

                    @if(isset($metricas['r2']))
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white dark:bg-gray-700 p-4 rounded-xl border border-gray-100 dark:border-gray-600 text-center">
                                <p class="text-xs text-gray-400 uppercase font-bold">Precisión (R²)</p>
                                <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ number_format($metricas['r2'], 2) }}</p>
                            </div>
                            <div class="bg-white dark:bg-gray-700 p-4 rounded-xl border border-gray-100 dark:border-gray-600 text-center">
                                <p class="text-xs text-gray-400 uppercase font-bold">Error (RMSE)</p>
                                <p class="text-2xl font-bold text-orange-500">±{{ number_format($metricas['rmse'], 1) }}</p>
                            </div>
                        </div>
                        <div class="mt-4 text-xs text-gray-400 text-center">
                            Entrenado el: {{ $metricas['fecha_entrenamiento'] ?? 'N/A' }}
                        </div>
                    @else
                        <div class="text-center text-gray-400 py-6">Modelo no cargado</div>
                    @endif
                </div>

             </div>
        </div>
    </div>
</div>