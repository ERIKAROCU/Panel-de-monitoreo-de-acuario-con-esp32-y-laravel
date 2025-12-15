<div>
    {{-- Mensaje Flash de Configuración --}}
    @if (session()->has('message_config'))
        <div class="mb-4 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg text-center font-bold">
            {{ session('message_config') }}
        </div>
    @endif

    {{-- 1. SECCIÓN DE FILTROS --}}
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg mb-8">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            
            {{-- CABECERA CON BOTÓN DE CONFIGURACIÓN --}}
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Filtros de Búsqueda</h3>
                
                {{-- BOTÓN TUERCA (CONFIGURACIÓN) --}}
                <button 
                    wire:click="openConfigModal"
                    class="text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all transform hover:rotate-90 p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700"
                    title="Configurar Sensores"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
            </div>

            {{-- FORMULARIO DE FILTROS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                 {{-- ... (Tus inputs de filtros igual que antes) ... --}}
                <div>
                    <label for="fecha_desde_h" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Desde:</label>
                    <input wire:model.live="filtroFechaDesde" id="fecha_desde_h" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                </div>
                <div>
                    <label for="fecha_hasta_h" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hasta:</label>
                    <input wire:model.live="filtroFechaHasta" id="fecha_hasta_h" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                </div>
                <div>
                    <label for="filtro_luz_h" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nivel de Luz:</label>
                    <select wire:model.live="filtroLuz" id="filtro_luz_h" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                        <option value="">Todos</option>
                        <option value="1">Encendida</option>
                        <option value="0">Apagada</option>
                    </select>
                </div>
            </div>

            {{-- BOTÓN DE EXPORTAR --}}
            <div class="mt-6 flex flex-col md:flex-row md:justify-end">
                <button 
                    wire:click="exportarExcel"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 cursor-wait"
                    class="inline-flex items-center justify-center w-full md:w-auto px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150"
                >
                    <svg wire:loading wire:target="exportarExcel" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>

                    <svg wire:loading.remove wire:target="exportarExcel" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 -ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>

                    <span wire:loading.remove wire:target="exportarExcel">Exportar a Excel</span>
                    <span wire:loading wire:target="exportarExcel">Exportando...</span>
                </button>
            </div>
        </div>
    </div>

    {{-- 2. SECCIÓN DE TABLA DE HISTORIAL (Igual que antes) --}}
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
        {{-- ... Código de tu tabla ... --}}
        <div class="p-6 text-gray-900 dark:text-gray-100">
             {{-- ... Tu tabla de siempre ... --}}
            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Historial Reciente</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha y Hora</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">T. Agua</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">T. Amb.</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Humedad</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">TDS</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Luz</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($historial as $lectura)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-200">{{ $lectura->fecha->format('d/m/Y h:i:s A') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-200 font-medium">{{ number_format($lectura->temp_agua, 1) }} °C</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-200">{{ number_format($lectura->temp_ambiente, 1) }} °C</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-200">{{ number_format($lectura->humedad, 1) }} %</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-200">{{ $lectura->tds }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($lectura->luz == 1)
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">ON</span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">OFF</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-400">
                                    No se encontraron registros con esos filtros.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                @if ($historial)
                    {{ $historial->links() }}
                @endif
            </div>
        </div>
    </div>

    {{-- INCLUIR EL NUEVO MODAL --}}
    @include('livewire.control.partials.config-readesp32-modal')

</div>