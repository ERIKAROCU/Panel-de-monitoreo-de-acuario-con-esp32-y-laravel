<div class="bg-gray-100 dark:bg-gray-900 py-12" wire:poll.5s>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">
            Dashboard Acuario
        </h1>

        @if ($lecturaActual)

            @if ($activeTab == 'dashboard')
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                    
                    <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow-md flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 dark:bg-blue-900">
                                <svg class="h-6 w-6 text-blue-600 dark:text-blue-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.06c0-1.336-1.078-2.414-2.414-2.414S8.672 2.724 8.672 4.06v9.654a4.5 4.5 0 104.828 0V4.06zM12 14.25a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Temp. Agua</h3>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ number_format($lecturaActual->temp_agua, 1) }} °C</p>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow-md flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-full bg-orange-100 dark:bg-orange-900">
                                <svg class="h-6 w-6 text-orange-600 dark:text-orange-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-6.364-.386l1.591-1.591M3 12h2.25m.386-6.364l1.591 1.591M12 12a2.25 2.25 0 00-2.25 2.25v.01c0 1.12 1.112 2.006 2.45 2.006s2.45-.886 2.45-2.006v-.01A2.25 2.25 0 0012 12z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Temp. Ambiente</h3>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ number_format($lecturaActual->temp_ambiente, 1) }} °C</p>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow-md flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-full bg-cyan-100 dark:bg-cyan-900">
                                <svg class="h-6 w-6 text-cyan-600 dark:text-cyan-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Humedad</h3>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ number_format($lecturaActual->humedad, 1) }} %</p>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow-md flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-full bg-green-100 dark:bg-green-900">
                                <svg class="h-6 w-6 text-green-600 dark:text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75h-.008a.75.75 0 01-.75-.75v-.008a.75.75 0 01.75-.75zM12 9a.75.75 0 00-.75.75v5.25a.75.75 0 00.75.75h.008a.75.75 0 00.75-.75V9.75a.75.75 0 00-.75-.75H12z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">TDS (Calidad)</h3>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $lecturaActual->tds }}</p>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow-md flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 dark:bg-yellow-900">
                                <svg class="h-6 w-6 text-yellow-600 dark:text-yellow-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v.01M12 6v.01M6 12h.01M18 12h.01M8.025 8.025l.01.01M15.965 15.965l.01.01M8.025 15.965l.01-.01M15.965 8.025l.01-.01" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 21a5.25 5.25 0 005.25-5.25H5.25A5.25 5.25 0 0010.5 21zM10.5 3c2.9 0 5.25 2.35 5.25 5.25h-10.5C5.25 5.35 7.6 3 10.5 3z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nivel de Luz</h3>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">
                                {{ $lecturaActual->luz == 1 ? 'Encendida' : 'Apagada' }}
                            </p>
                        </div>
                    </div>
                </div> <div x-data="{ 
                         chartData: @entangle('dashboardChartData'),
                         miniCharts: {} 
                     }" 
                     x-init="
                         console.log('Alpine init run. Initial data:', chartData);
                         
                         drawMiniCharts(chartData, miniCharts); // Dibuja en la carga

                         $watch('chartData', (newData) => {
                             console.log('Chart data updated by poll. New data:', newData);
                             drawMiniCharts(newData, miniCharts); // Redibuja en el poll
                         });
                     ">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md h-64 flex flex-col">
                            <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-2 text-center">Temperaturas Actuales</h4>
                            <div class="flex-grow">
                                <canvas id="miniChartTemps"></canvas>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md h-64 flex flex-col">
                            <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-2 text-center">Estado Luz Actual</h4>
                            <div class="flex-grow">
                                <canvas id="miniChartLight"></canvas>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md h-64 flex flex-col">
                            <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-2 text-center">Humedad Actual</h4>
                            <div class="flex-grow">
                                <canvas id="miniChartHumidity"></canvas>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md h-64 flex flex-col">
                            <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-2 text-center">TDS Actual</h4>
                            <div class="flex-grow relative"> 
                                <canvas id="miniChartTDS"></canvas>
                            </div>
                        </div>
                    </div>
                </div> <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    // Función para crear/actualizar gráfico de barras
                    // CAMBIO: Acepta 'chartInstanceStore' para guardar la instancia
                    function updateMiniBarChart(canvasId, label, labels, data, chartInstanceStore) {
                        const canvasElement = document.getElementById(canvasId);
                        if (!canvasElement) {
                            console.error(`Canvas element with ID ${canvasId} not found.`);
                            return;
                        }
                        const ctx = canvasElement.getContext('2d');
                        if (chartInstanceStore[canvasId]) {
                            chartInstanceStore[canvasId].destroy(); // Destruye el anterior
                        }
                        chartInstanceStore[canvasId] = new Chart(ctx, { // Guarda el nuevo
                            type: 'bar', data: { labels: labels, datasets: [{ label: label, data: data, backgroundColor: ['rgba(59, 130, 246, 0.6)', 'rgba(249, 115, 22, 0.6)'], borderColor: ['rgb(59, 130, 246)', 'rgb(249, 115, 22)'], borderWidth: 1 }] },
                            options: { indexAxis: 'y', scales: { x: { beginAtZero: true } }, plugins: { legend: { display: false } }, responsive: true, maintainAspectRatio: false }
                        });
                    }

                    // Función para crear/actualizar gráfico de dona/anillo
                    // CAMBIO: Acepta 'chartInstanceStore'
                    function updateMiniDoughnutChart(canvasId, labels, data, colors, chartInstanceStore, cutout = '50%') {
                        const canvasElement = document.getElementById(canvasId);
                         if (!canvasElement) {
                            console.error(`Canvas element with ID ${canvasId} not found.`);
                            return;
                        }
                        const ctx = canvasElement.getContext('2d');
                        if (chartInstanceStore[canvasId]) {
                            chartInstanceStore[canvasId].destroy(); // Destruye el anterior
                        }
                        chartInstanceStore[canvasId] = new Chart(ctx, { // Guarda el nuevo
                            type: 'doughnut', data: { labels: labels, datasets: [{ data: data, backgroundColor: colors.bg, borderColor: colors.border, borderWidth: 1 }] },
                            options: { cutout: cutout, plugins: { legend: { position: 'bottom' } }, responsive: true, maintainAspectRatio: false }
                        });
                    }

                    // NUEVO: Función "controladora" que llama Alpine
                    // Esta función dibuja TODOS los mini gráficos
                    function drawMiniCharts(data, chartInstanceStore) {
                        if (!data) {
                            //console.warn('drawMiniCharts called with no data (e.g. during init).');
                            return;
                        }
                        
                        // 1. Gráfico de barras Temperaturas
                        updateMiniBarChart('miniChartTemps', 'Temperaturas', data.labels, data.temperatures, chartInstanceStore);
                        
                        // 2. Dona Estado Luz
                        updateMiniDoughnutChart('miniChartLight', ['Encendida', 'Apagada'], data.lightStatus, { bg: ['rgba(234, 179, 8, 0.6)', 'rgba(107, 114, 128, 0.6)'], border: ['rgb(234, 179, 8)', 'rgb(107, 114, 128)'] }, chartInstanceStore);

                        // 3. Anillo Humedad
                        updateMiniDoughnutChart('miniChartHumidity', ['Humedad', ''], data.humidity, { bg: ['rgba(6, 182, 212, 0.6)', 'rgba(229, 231, 235, 0.6)'], border: ['rgb(6, 182, 212)', 'rgb(209, 213, 219)'] }, chartInstanceStore, '80%'); 

                        // 4. Medidor TDS (anillo)
                        const maxTDS = 1000; 
                        const tdsPercentage = data.tdsValue <= maxTDS ? data.tdsValue : maxTDS;
                        const remainingTDS = maxTDS - tdsPercentage > 0 ? maxTDS - tdsPercentage : 0;
                        updateMiniDoughnutChart('miniChartTDS', ['TDS Actual', ''], [tdsPercentage, remainingTDS], { bg: ['rgba(34, 197, 94, 0.6)', 'rgba(229, 231, 235, 0.6)'], border: ['rgb(34, 197, 94)', 'rgb(209, 213, 219)'] }, chartInstanceStore, '80%');
                    }

                    // ELIMINADAS: 
                    // - function initMiniCharts() 
                    // - function handleNavigationCleanup()
                    // - Livewire.on('updateDashboardCharts', ...)
                    // Ya no son necesarias, Alpine maneja todo.

                </script>

            
            @elseif ($activeTab == 'charts')

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
                    Livewire.on('updateChart', data => {
                        updateLargeChart('chartTempAgua', 'Temp. Agua', data.labels, data.tempAgua, 'rgb(59, 130, 246)', 'rgba(59, 130, 246, 0.1)');
                        updateLargeChart('chartTempAmb', 'Temp. Ambiente', data.labels, data.tempAmb, 'rgb(249, 115, 22)', 'rgba(249, 115, 22, 0.1)');
                        updateLargeChart('chartHumedad', 'Humedad', data.labels, data.humedad, 'rgb(6, 182, 212)', 'rgba(6, 182, 212, 0.1)');
                        updateLargeChart('chartTDS', 'TDS', data.labels, data.tds, 'rgb(34, 197, 94)', 'rgba(34, 197, 94, 0.1)');
                        updateLargeStepChart('chartLuz', 'Luz', data.labels, data.luz, 'rgb(234, 179, 8)', 'rgba(234, 179, 8, 0.1)');
                    });
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

            @elseif ($activeTab == 'historial')

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg mb-8">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Filtros de Búsqueda</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="fecha_desde" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Desde:</label>
                                <input 
                                    wire:model.live="filtroFechaDesde" 
                                    id="fecha_desde" 
                                    type="date" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                            </div>

                            <div>
                                <label for="fecha_hasta" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hasta:</label>
                                <input 
                                    wire:model.live="filtroFechaHasta" 
                                    id="fecha_hasta" 
                                    type="date" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                            </div>

                            <div>
                                <label for="filtro_luz" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nivel de Luz:</label>
                                <select 
                                    wire:model.live="filtroLuz" 
                                    id="filtro_luz" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                                    <option value="">Todos</option>
                                    <option value="1">Encendida</option>
                                    <option value="0">Apagada</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

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

            @endif 

        @else
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-12 text-gray-900 dark:text-gray-100 text-center">
                    <svg class="h-16 w-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h15.75c.621 0 1.125.504 1.125 1.125v6.75c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 013 19.875v-6.75zM3 8.625c0-.621.504-1.125 1.125-1.125h15.75c.621 0 1.125.504 1.125 1.125v3.375c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 013 12V8.625zM3 4.125C3 3.504 3.504 3 4.125 3h15.75c.621 0 1.125.504 1.125 1.125v3.375c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 013 7.5V4.125z" />
                    </svg>

                    <p class="text-xl font-semibold text-gray-700 dark:text-gray-200">Aún no hay datos.</p>
                    <p class="text-gray-500 dark:text-gray-400 mt-2">Esperando la primera lectura de los sensores...</p>
                </div>
            </div>
        @endif 

    </div>
</div>