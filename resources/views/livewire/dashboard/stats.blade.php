<div>
    {{-- 1. SECCIÓN DE TARJETAS DE ESTADO --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        
        <!-- Temp. Agua -->
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
                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ number_format($lectura->temp_agua, 1) }} °C</p>
            </div>
        </div>

        <!-- Temp. Ambiente -->
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
                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ number_format($lectura->temp_ambiente, 1) }} °C</p>
            </div>
        </div>

        <!-- Humedad -->
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
                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ number_format($lectura->humedad, 1) }} %</p>
            </div>
        </div>

        <!-- TDS -->
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
                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $lectura->tds }}</p>
            </div>
        </div>

        <!-- Nivel de Luz -->
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
                    {{ $lectura->luz == 1 ? 'Encendida' : 'Apagada' }}
                </p>
            </div>
        </div>
    </div>

    {{-- 2. SECCIÓN DE MINI GRÁFICOS --}}
    <div x-data="{ 
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
    </div>

    {{-- 3. SCRIPT PARA MINI GRÁFICOS (Ahora vive dentro de este componente) --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Función para crear/actualizar gráfico de barras
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

        // Función "controladora" que llama Alpine
        function drawMiniCharts(data, chartInstanceStore) {
            if (!data) {
                return;
            }
            
            updateMiniBarChart('miniChartTemps', 'Temperaturas', data.labels, data.temperatures, chartInstanceStore);
            updateMiniDoughnutChart('miniChartLight', ['Encendida', 'Apagada'], data.lightStatus, { bg: ['rgba(234, 179, 8, 0.6)', 'rgba(107, 114, 128, 0.6)'], border: ['rgb(234, 179, 8)', 'rgb(107, 114, 128)'] }, chartInstanceStore);
            updateMiniDoughnutChart('miniChartHumidity', ['Humedad', ''], data.humidity, { bg: ['rgba(6, 182, 212, 0.6)', 'rgba(229, 231, 235, 0.6)'], border: ['rgb(6, 182, 212)', 'rgb(209, 213, 219)'] }, chartInstanceStore, '80%'); 

            const maxTDS = 1000; 
            const tdsPercentage = data.tdsValue <= maxTDS ? data.tdsValue : maxTDS;
            const remainingTDS = maxTDS - tdsPercentage > 0 ? maxTDS - tdsPercentage : 0;
            updateMiniDoughnutChart('miniChartTDS', ['TDS Actual', ''], [tdsPercentage, remainingTDS], { bg: ['rgba(34, 197, 94, 0.6)', 'rgba(229, 231, 235, 0.6)'], border: ['rgb(34, 197, 94)', 'rgb(209, 213, 219)'] }, chartInstanceStore, '80%');
        }
    </script>
</div>
