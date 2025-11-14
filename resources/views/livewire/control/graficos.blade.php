{{-- CAMBIO 1: Añadido 'x-data', 'x-init' y 'wire:poll.5s' --}}
<div x-data="graficosComponent()" x-init="init()" wire:poll.5s>

    {{-- 1. SECCIÓN DE FILTROS (Sin cambios) --}}
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg mb-8">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Filtros de Gráficos</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Los gráficos muestran los últimos 100 registros que coincidan con los filtros.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="fecha_desde_g" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Desde:</label>
                    <input 
                        wire:model.live="filtroFechaDesde" 
                        id="fecha_desde_g" 
                        type="date" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                </div>
                <div>
                    <label for="fecha_hasta_g" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hasta:</label>
                    <input 
                        wire:model.live="filtroFechaHasta" 
                        id="fecha_hasta_g" 
                        type="date" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                </div>
                <div>
                    <label for="filtro_luz_g" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nivel de Luz:</label>
                    <select 
                        wire:model.live="filtroLuz" 
                        id="filtro_luz_g" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                        <option value="">Todos</option>
                        <option value="1">Encendida</option>
                        <option value="0">Apagada</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. SECCIÓN DE GRÁFICOS --}}
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Gráficos de Sensores</h3>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            {{-- CAMBIO 2: Aplicando 'h-96' a TODOS los gráficos para dar espacio a las etiquetas --}}
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-inner h-96">
                <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-3">Temperatura del Agua (°C)</h4>
                <canvas id="chartTempAgua"></canvas>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-inner h-96">
                <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-3">Temperatura Ambiente (°C)</h4>
                <canvas id="chartTempAmb"></canvas>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-inner h-96">
                <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-3">Humedad (%)</h4>
                <canvas id="chartHumedad"></canvas>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-inner h-96">
                <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-3">TDS (Calidad Agua)</h4>
                <canvas id="chartTDS"></canvas>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-inner lg:col-span-2 h-96">
                <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-3">Nivel de Luz (0=Apagada, 1=Encendida)</h4>
                <canvas id="chartLuz"></canvas>
            </div>
        </div>
    </div>
</div>
{{-- 3. SCRIPT PARA GRÁFICOS (VERSIÓN ROBUSTA SIN "SALTOS") --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let largeCharts = {}; 

    /**
     * 🔹 SOLUCIÓN ALTERNATIVA: 
     * Usamos 'destroy()' (fiable para el layout) 
     * y 'animation: false' (para eliminar el "salto").
     */
    function updateLargeChart(canvasId, label, labels, data, borderColor, backgroundColor) {
        const canvasElement = document.getElementById(canvasId);
        if (!canvasElement) return; 
        const ctx = canvasElement.getContext('2d');

        // --- Lógica "responsive" para móvil (se mantiene) ---
        const isMobile = window.innerWidth < 768;
        const labelsToShow = isMobile ? labels.slice(-15) : labels;
        const dataToShow = isMobile ? data.slice(-15) : data;

        // --- 1. Usamos destroy() ---
        // Esto asegura que el layout (padding, aspect ratio) se aplique siempre.
        if (largeCharts[canvasId]) {
            largeCharts[canvasId].destroy();
        }

        // --- 2. Configuramos el gráfico CADA VEZ ---
        
        // Configuración específica para LUZ
        const isLuz = (canvasId === 'chartLuz');
        const yAxisConfig = {
            beginAtZero: isLuz ? true : false,
            max: isLuz ? 1.1 : undefined, // Eje Y de 0 a 1.1 para el gráfico de Luz
            ticks: { 
                stepSize: isLuz ? 1 : undefined, // Marcas solo en 0 y 1
                color: document.documentElement.classList.contains('dark') ? '#e5e7eb' : '#374151' 
            }, 
            grid: { color: document.documentElement.classList.contains('dark') ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.1)' }
        };

        const config = {
            type: 'line',
            data: {
                labels: labelsToShow,
                datasets: [{
                    label: label,
                    data: dataToShow,
                    borderColor: borderColor,
                    backgroundColor: backgroundColor,
                    borderWidth: 2,
                    fill: false,
                    tension: isLuz ? 0 : 0.1,    // Línea recta para LUZ
                    stepped: isLuz ? true : false, // Gráfico escalonado para LUZ
                }]
            },
            options: { 
                // 🚀 ¡LA SOLUCIÓN! (Combinación) 🚀
                
                // 1. Para arreglar el "corte" (respeta h-96)
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        bottom: 40 // Espacio para las fechas
                    }
                },
                
                // 2. Para arreglar el "salto" (actualización instantánea)
                // animation: false, // <-- DESHABILITA TODAS LAS ANIMACIONES

                scales: {
                    y: yAxisConfig,
                    x: { 
                        ticks: { 
                            color: document.documentElement.classList.contains('dark') ? '#e5e7eb' : '#374151', 
                            maxRotation: 90,
                            minRotation: 90,
                            font: { size: 10 },
                            autoSkip: true 
                        }, 
                        grid: { display: false } 
                    }
                },
                plugins: { 
                    legend: { 
                        display: true, 
                        labels: { color: document.documentElement.classList.contains('dark') ? '#e5e7eb' : '#374151' } 
                    } 
                }
            }
        };

        // 3. Creamos el nuevo gráfico
        largeCharts[canvasId] = new Chart(ctx, config);
    }
    
    // --- FUNCIÓN DEL COMPONENTE ALPINE (Sin cambios) ---
    function graficosComponent() {
        return {
            init() {
                @this.on('updateChart', (data) => {
                    // Usamos setTimeout para evitar parpadeos
                    setTimeout(() => {
                        updateLargeChart('chartTempAgua', 'Temp. Agua', data.labels, data.tempAgua, 'rgb(59, 130, 246)', 'rgba(59, 130, 246, 0.1)');
                        updateLargeChart('chartTempAmb', 'Temp. Ambiente', data.labels, data.tempAmb, 'rgb(249, 115, 22)', 'rgba(249, 115, 22, 0.1)');
                        updateLargeChart('chartHumedad', 'Humedad', data.labels, data.humedad, 'rgb(6, 182, 212)', 'rgba(6, 182, 212, 0.1)');
                        updateLargeChart('chartTDS', 'TDS', data.labels, data.tds, 'rgb(34, 197, 94)', 'rgba(34, 197, 94, 0.1)');
                        updateLargeChart('chartLuz', 'Luz', data.labels, data.luz, 'rgb(234, 179, 8)', 'rgba(234, 179, 8, 0.1)');
                    }, 10); 
                });
            }
        }
    }
    
    // Limpieza de gráficos (Sin cambios)
    document.addEventListener('alpine:navigated', () => {
        const urlParams = new URLSearchParams(window.location.search);
        const currentTab = urlParams.get('tab') || 'dashboard'; 
        if (currentTab !== 'charts') { // Asegúrate que 'charts' sea el nombre de tu pestaña
            Object.values(largeCharts).forEach(chart => {
                if (chart) chart.destroy();
            });
            largeCharts = {};
        }
    });

</script>