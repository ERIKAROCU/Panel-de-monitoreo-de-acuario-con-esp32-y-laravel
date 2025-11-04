<div>
    {{-- 1. SECCIÓN DE FILTROS (copiada de Historial) --}}
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

    {{-- 2. SECCIÓN DE GRÁFICOS (movida aquí) --}}
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Gráficos de Sensores</h3>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-inner h-72">
                <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-3">Temperatura del Agua (°C)</h4>
                <canvas id="chartTempAgua"></canvas>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-inner h-72">
                <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-3">Temperatura Ambiente (°C)</h4>
                <canvas id="chartTempAmb"></canvas>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-inner h-72">
                <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-3">Humedad (%)</h4>
                <canvas id="chartHumedad"></canvas>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-inner h-72">
                <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-3">TDS (Calidad Agua)</h4>
                <canvas id="chartTDS"></canvas>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-inner lg:col-span-2 h-72">
                <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-3">Nivel de Luz (0=Apagada, 1=Encendida)</h4>
                <canvas id="chartLuz"></canvas>
            </div>
        </div>
    </div>

    {{-- 3. SCRIPT PARA GRÁFICOS (Ahora vive aquí) --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let largeCharts = {}; 
        
        function updateLargeChart(canvasId, label, labels, data, borderColor, backgroundColor) {
            const canvasElement = document.getElementById(canvasId);
            if (!canvasElement) return; 
            const ctx = canvasElement.getContext('2d');
            if (largeCharts[canvasId]) {
                largeCharts[canvasId].destroy();
            }
            largeCharts[canvasId] = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        borderColor: borderColor,
                        backgroundColor: backgroundColor,
                        borderWidth: 2,
                        fill: false,
                        tension: 0.1 
                    }]
                },
                options: {
                    scales: {
                        y: { beginAtZero: false, ticks: { color: document.documentElement.classList.contains('dark') ? '#e5e7eb' : '#374151' }, grid: { color: document.documentElement.classList.contains('dark') ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.1)' } },
                        x: { ticks: { color: document.documentElement.classList.contains('dark') ? '#e5e7eb' : '#374151', maxRotation: 45, minRotation: 45 }, grid: { display: false } }
                    },
                    plugins: { legend: { display: true, labels: { color: document.documentElement.classList.contains('dark') ? '#e5e7eb' : '#374151' } } },
                    responsive: true,
                    maintainAspectRatio: false 
                }
            });
        }
        
        function updateLargeStepChart(canvasId, label, labels, data, borderColor, backgroundColor) {
            const canvasElement = document.getElementById(canvasId);
            if (!canvasElement) return; 
            const ctx = canvasElement.getContext('2d');
            if (largeCharts[canvasId]) {
                largeCharts[canvasId].destroy();
            }
            largeCharts[canvasId] = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        borderColor: borderColor,
                        backgroundColor: backgroundColor,
                        borderWidth: 2,
                        fill: false,
                        stepped: true 
                    }]
                },
                options: {
                    scales: {
                        y: { beginAtZero: true, max: 1.1, ticks: { stepSize: 1, color: document.documentElement.classList.contains('dark') ? '#e5e7eb' : '#374151' }, grid: { color: document.documentElement.classList.contains('dark') ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.1)' } },
                        x: { ticks: { color: document.documentElement.classList.contains('dark') ? '#e5e7eb' : '#374151', maxRotation: 45, minRotation: 45 }, grid: { display: false } }
                    },
                    plugins: { legend: { display: true, labels: { color: document.documentElement.classList.contains('dark') ? '#e5e7eb' : '#374151' } } },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }

        // El listener ahora vive dentro del componente que despacha el evento
        document.addEventListener('livewire:initialized', () => {
             @this.on('updateChart', (data) => {
                // Pequeño delay para asegurar que el DOM está listo
                setTimeout(() => {
                    updateLargeChart('chartTempAgua', 'Temp. Agua', data.labels, data.tempAgua, 'rgb(59, 130, 246)', 'rgba(59, 130, 246, 0.1)');
                    updateLargeChart('chartTempAmb', 'Temp. Ambiente', data.labels, data.tempAmb, 'rgb(249, 115, 22)', 'rgba(249, 115, 22, 0.1)');
                    updateLargeChart('chartHumedad', 'Humedad', data.labels, data.humedad, 'rgb(6, 182, 212)', 'rgba(6, 182, 212, 0.1)');
                    updateLargeChart('chartTDS', 'TDS', data.labels, data.tds, 'rgb(34, 197, 94)', 'rgba(34, 197, 94, 0.1)');
                    updateLargeStepChart('chartLuz', 'Luz', data.labels, data.luz, 'rgb(234, 179, 8)', 'rgba(234, 179, 8, 0.1)');
                }, 10); // 10ms delay
            });
        });
        
        // Limpieza de gráficos cuando se navega fuera de la pestaña
        document.addEventListener('alpine:navigated', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const currentTab = urlParams.get('tab') || 'dashboard'; 
            if (currentTab !== 'charts') {
                Object.values(largeCharts).forEach(chart => {
                    if (chart) chart.destroy();
                });
                largeCharts = {};
            }
        });

    </script>
</div>
