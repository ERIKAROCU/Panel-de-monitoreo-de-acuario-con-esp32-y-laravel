<div class="border border-gray-200 dark:border-gray-700 rounded-xl p-5 bg-gray-50/50 dark:bg-gray-800/50 hover:border-{{ $color }}-400 dark:hover:border-{{ $color }}-600 transition-all duration-300 relative group">
    
    {{-- Header: Icono y Título --}}
    <div class="flex justify-between items-start mb-4">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">{{ $title }}</p>
            <div class="flex items-baseline mt-1">
                <span class="text-2xl font-extrabold text-gray-800 dark:text-white">{{ $current ?? '0' }}</span>
                <span class="text-sm font-medium text-gray-500 ml-1">{{ $unit }}</span>
            </div>
            <p class="text-[10px] text-gray-400 mt-0.5">Valor Actual</p>
        </div>
        <div class="p-2 bg-{{ $color }}-100 dark:bg-{{ $color }}-900/20 rounded-lg">
            {!! $icon !!}
        </div>
    </div>

    {{-- Separador --}}
    <div class="border-t border-gray-200 dark:border-gray-700 my-3"></div>

    {{-- Footer: Predicciones --}}
    @if($forecast)
        <div class="space-y-3">
            
            {{-- NUEVO: Predicción Corto Plazo (10 min) --}}
            {{-- USAMOS ?? '--' PARA QUE NO FALLE SI PYTHON NO ENVÍA EL DATO --}}
            <div class="flex justify-between items-center text-sm border-b border-gray-100 dark:border-gray-700 pb-2">
                <div class="flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-indigo-500 animate-pulse" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wide">En 10 min:</span>
                </div>
                <span class="font-bold text-gray-800 dark:text-white">{{ $forecast['10min'] ?? '--' }} {{ $unit }}</span>
            </div>

            {{-- Predicción Mediano Plazo (24h) --}}
            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-500 dark:text-gray-400">En 24h:</span>
                <span class="font-bold text-gray-700 dark:text-gray-200">{{ $forecast['24h'] ?? '--' }} {{ $unit }}</span>
            </div>
            
            {{-- Tendencia con Colores --}}
            <div class="flex items-center justify-between mt-1">
                <span class="text-[10px] text-gray-400 uppercase">Tendencia:</span>
                <div class="flex items-center gap-1 text-xs font-semibold uppercase">
                    @php $tendencia = $forecast['tendencia'] ?? 'estable'; @endphp
                    
                    @if($tendencia == 'sube')
                        <svg class="w-3 h-3 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                        <span class="text-red-500">Sube</span>
                    @elseif($tendencia == 'baja')
                        <svg class="w-3 h-3 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" /></svg>
                        <span class="text-green-500">Baja</span>
                    @else
                        <span class="text-gray-400">Estable</span>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="text-xs text-gray-400 italic">Sin predicción</div>
    @endif
</div>