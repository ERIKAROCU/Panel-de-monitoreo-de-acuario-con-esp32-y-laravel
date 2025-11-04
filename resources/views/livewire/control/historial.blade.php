<div>
    {{-- 1. SECCIÓN DE FILTROS --}}
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg mb-8">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Filtros de Búsqueda</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="fecha_desde_h" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Desde:</label>
                    <input 
                        wire:model.live="filtroFechaDesde" 
                        id="fecha_desde_h" 
                        type="date" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                </div>
                <div>
                    <label for="fecha_hasta_h" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hasta:</label>
                    <input 
                        wire:model.live="filtroFechaHasta" 
                        id="fecha_hasta_h" 
                        type="date" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                </div>
                <div>
                    <label for="filtro_luz_h" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nivel de Luz:</label>
                    <select 
                        wire:model.live="filtroLuz" 
                        id="filtro_luz_h" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                        <option value="">Todos</option>
                        <option value="1">Encendida</option>
                        <option value="0">Apagada</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. SECCIÓN DE TABLA DE HISTORIAL --}}
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
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
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            ON
                                        </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                            OFF
                                        </span>
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
</div>
