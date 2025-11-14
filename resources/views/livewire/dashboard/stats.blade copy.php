<div wire:poll.5s
    x-data="{}" 
    x-init="drawStatCharts({{ json_encode($lectura) }})"
    @actualizar-graficos.window="drawStatCharts($event.detail.lectura)"
>
    {{-- =============== TARJETAS DE ESTADO (OPTIMIZADAS) =============== --}}
    <div wire:ignore class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-6">
        
        {{-- Temperatura del Agua --}}
        <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-md flex flex-col items-center">
            <div class="flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 dark:bg-blue-900 mb-1">
                <i data-lucide="thermometer-snowflake" class="w-10 h-10 text-blue-500"></i>
            </div>
            <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mt-1">Temperatura del Agua</h3>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ number_format($lectura->temp_agua, 1) }} °C
            </p>
        </div>

        {{-- Temperatura Ambiente --}}
        <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-md flex flex-col items-center">
            <div class="flex items-center justify-center w-16 h-16 rounded-full bg-orange-100 dark:bg-orange-900 mb-1">
                <i data-lucide="sun" class="w-10 h-10 text-orange-500"></i>
            </div>
            <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mt-1">Temperatura Ambiente</h3>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ number_format($lectura->temp_ambiente, 1) }} °C
            </p>
        </div>

        {{-- Humedad --}}
        <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-md flex flex-col items-center">
            <div class="flex items-center justify-center w-16 h-16 rounded-full bg-cyan-100 dark:bg-cyan-900 mb-1">
                <i data-lucide="droplets" class="w-10 h-10 text-cyan-500"></i>
            </div>
            <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mt-1">Humedad</h3>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ number_format($lectura->humedad, 1) }} %
            </p>
        </div>

        {{-- TDS --}}
        <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-md flex flex-col items-center">
            <div class="flex items-center justify-center w-16 h-16 rounded-full bg-green-100 dark:bg-green-900 mb-1">
                <i data-lucide="beaker" class="w-50 h-50 text-green-500"></i>
            </div>
            <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mt-1">TDS</h3>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ $lectura->tds }} 
            </p>
        </div>

        {{-- Luz --}}
        <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-md flex flex-col items-center">
            <div class="flex items-center justify-center w-16 h-16 rounded-full bg-yellow-100 dark:bg-yellow-900 mb-1">
                <i data-lucide="lightbulb" class="w-10 h-10 text-yellow-500"></i>
            </div>
            <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mt-1">Luz</h3>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ $lectura->luz == 1 ? 'Encendida' : 'Apagada' }}
            </p>
        </div>

    </div>

    {{-- =============== LEYENDA / INTERPRETACIÓN ENTRE ICONOS Y GRÁFICOS =============== --}}
    <div class="flex flex-wrap justify-center gap-4 text-sm text-gray-600 dark:text-gray-300 my-6">
        <div class="flex items-center gap-1">
            <span class="w-3 h-3 rounded-full bg-blue-500"></span>
            <span>Bajo</span>
        </div>
        <div class="flex items-center gap-1">
            <span class="w-3 h-3 rounded-full bg-green-500"></span>
            <span>Óptimo</span>
        </div>
        <div class="flex items-center gap-1">
            <span class="w-3 h-3 rounded-full bg-red-500"></span>
            <span>Alto</span>
        </div>
        <div class="flex items-center gap-1">
            <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
            <span>Activa (Luz)</span>
        </div>
        <div class="flex items-center gap-1">
            <span class="w-3 h-3 rounded-full bg-gray-400"></span>
            <span>Inactiva (Luz)</span>
        </div>
    </div>


    {{-- =============== NUEVA FILA DE GRÁFICOS INTERPRETATIVOS =============== --}}
    <div wire:ignore class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 mt-10 mb-6">
        {{-- Temperatura Agua --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center">
            <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-3">Temp. Agua</h4>
            <div class="w-full h-48 relative">
                <canvas id="statChartTempAgua"></canvas>
                <div id="textChartTempAgua" 
                     class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 
                            text-2xl font-bold text-gray-800 dark:text-gray-200"></div>
            </div>
            
        </div>
        

        {{-- Temperatura Ambiente --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center">
            <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-3">Temp. Ambiente</h4>
            <div class="w-full h-48 relative">
                <canvas id="statChartTempAmb"></canvas>
                <div id="textChartTempAmb" 
                     class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 
                            text-2xl font-bold text-gray-800 dark:text-gray-200"></div>
            </div>
        </div>

        {{-- Humedad --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center">
            <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-3">Humedad</h4>

            <div class="w-full h-48 relative flex items-center justify-center">
                <canvas id="statChartHumedad"></canvas>

                <!-- 🔹 Contenedor central (valor + ícono) -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center space-y-1">
                    <!-- Valor de humedad -->
                    <div id="textChartHumedad" 
                        class="text-2xl font-bold text-gray-800 dark:text-gray-200"></div>

                    <!-- Ícono de termómetro (más grande) -->
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        fill="none" viewBox="0 0 24 24" stroke-width="2.5" 
                        stroke="white" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                            d="M14 14.76V5a2 2 0 10-4 0v9.76a5 5 0 104 0z" />
                    </svg>
                </div>
            </div>
        </div>


       {{-- TDS --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center justify-center">
            <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-3">TDS (Calidad)</h4>

            <div class="relative w-52 h-44 flex items-center justify-center"> 
                <!-- 🔹 centrado con flex -->
                <canvas id="statChartTDS" class="w-full h-full"></canvas>

                <div id="textChartTDS" 
                    class="absolute top-1/2 left-1/2 
                            -translate-x-1/2 -translate-y-1/2
                            text-3xl font-bold text-gray-800 dark:text-gray-200"></div>
            </div>
        </div>

        {{-- Luz --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center">
            <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-3">Nivel de Luz</h4>

            <!-- Contenedor del foco -->
            <div id="textChartLuz"
                class="relative flex flex-col items-center justify-center w-32 h-32">
                <svg id="iconLuz" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="2.5"
                    class="w-16 h-16 transition-all duration-700 ease-in-out">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 2a7 7 0 00-4 12v2a1 1 0 001 1h6a1 1 0 001-1v-2a7 7 0 00-4-12z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 21h6" />
                </svg>
                <p id="estadoLuz" class="mt-2 text-sm font-semibold text-gray-600 dark:text-gray-300"></p>
            </div>
        </div>
    </div>
</div>

    {{-- =============== SCRIPTS =============== --}}
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>lucide.createIcons();</script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- Aquí va tu script JS de gráficos --}}


    {{-- FIN DE LA NUEVA FILA DE GRÁFICOS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    let statCharts = {};

    // --- PLUGIN: AGUJA DEL GAUGE (CON ETIQUETAS 0% Y 100%) ---
    const gaugeNeedle = {
    id: 'gaugeNeedle',
    afterDraw(chart, args, pluginOptions) {
        if (!pluginOptions.enable) return;

        const { ctx } = chart;
        const dataset = chart.data.datasets[0];
        const value = dataset.data[0];
        const max = pluginOptions.max || 5000; // se pasa desde updateGaugeChart

        const meta = chart.getDatasetMeta(0);
        if (!meta || !meta.data || !meta.data[0]) return;

        const centerX = meta.data[0].x;
        const centerY = meta.data[0].y;
        const outerRadius = meta.data[0].outerRadius;
        const innerRadius = meta.data[0].innerRadius;
        const needleRadius = (innerRadius + outerRadius) / 2;

        // --- Calcular el ángulo correcto (de 180° a 360°)
        const angle = Math.PI * (1 + (value / max));

        const needleX = centerX + needleRadius * Math.cos(angle);
        const needleY = centerY + needleRadius * Math.sin(angle);

        const needleColor = document.documentElement.classList.contains('dark') 
            ? 'rgb(167, 139, 250)' 
            : 'rgb(139, 92, 246)';

        ctx.save();

        // Aguja
        ctx.beginPath();
        ctx.strokeStyle = needleColor;
        ctx.lineWidth = 3;
        ctx.moveTo(centerX, centerY);
        ctx.lineTo(needleX, needleY);
        ctx.stroke();

        // Centro
        ctx.beginPath();
        ctx.fillStyle = needleColor;
        ctx.arc(centerX, centerY, 6, 0, 2 * Math.PI);
        ctx.fill();

        // Etiquetas de 0 y max
        ctx.fillStyle = document.documentElement.classList.contains('dark') ? '#9ca3af' : '#6b7280';
        ctx.font = '12px sans-serif';
        ctx.textBaseline = 'middle';
        ctx.textAlign = 'left';
        ctx.fillText('0', centerX - outerRadius + 5, centerY - 5);
        ctx.textAlign = 'right';
        ctx.fillText(max, centerX + outerRadius - 5, centerY - 5);

        ctx.restore();
    }
};


    Chart.register(gaugeNeedle);
    // ------------------------------------


    // --- FUNCIÓN 1: GRÁFICO DE ANILLO (Para Temp) ---
    function updateDonutChart(canvasId, textId, label, value, max, color, unit) {
        if (value > max) { value = max; }
        if (value < 0) { value = 0; }
        
        const textElement = document.getElementById(textId);
        if(textElement) {
            let displayValue = value.toFixed(1);
            textElement.innerText = displayValue + unit;
        }

        const data = {
            labels: [label, 'Restante'],
            datasets: [{
                data: [value, max - value],
                backgroundColor: [ color, document.documentElement.classList.contains('dark') ? '#374151' : '#f3f4f6' ],
                borderWidth: 0,
                circumference: 270, // <-- 270 grados
                rotation: 225,      // <-- Rotado
            }]
        };
        const canvasElement = document.getElementById(canvasId);
        if (!canvasElement) return;
        const ctx = canvasElement.getContext('2d');
        if (statCharts[canvasId]) {
            statCharts[canvasId].destroy();
        }
        statCharts[canvasId] = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '80%',
                plugins: { legend: { display: false }, tooltip: { enabled: false } }
            }
        });
    }

    // --- FUNCIÓN 2: GRÁFICO DE BARRA VERTICAL (Para Humedad) ---
function updateVerticalBarChart(canvasId, textId, label, value, max, color, unit) {
    if (value > max) { value = max; }
    if (value < 0) { value = 0; }

    const textElement = document.getElementById(textId);
    if (textElement) {
        // Mostramos el valor + ícono
        textElement.innerHTML = `
            <div class="flex flex-col items-center justify-center">
                <span>${value.toFixed(0)}${unit}</span>
                <i data-lucide="droplet" class="w-6 h-6 text-white mt-1 opacity-80"></i>
            </div>
        `;
        lucide.createIcons(); // Asegura que el ícono se renderice
    }

    const data = {
        labels: [label],
        datasets: [
            {
                label: 'Valor',
                data: [value],
                backgroundColor: [color],
                borderWidth: 0,
                borderRadius: 8, // 🔹 Bordes redondeados
                barPercentage: 0.6,
                categoryPercentage: 0.8
            },
            {
                label: 'Restante',
                data: [max - value],
                backgroundColor: [
                    document.documentElement.classList.contains('dark') ? '#374151' : '#e5e7eb'
                ],
                borderWidth: 0,
                borderRadius: 8, // 🔹 Igual redondeado para coherencia
                barPercentage: 0.6,
                categoryPercentage: 0.8
            }
        ]
    };

    const canvasElement = document.getElementById(canvasId);
    if (!canvasElement) return;
    const ctx = canvasElement.getContext('2d');

    if (statCharts[canvasId]) {
        statCharts[canvasId].destroy();
    }

    statCharts[canvasId] = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: { enabled: false } },
            scales: {
                x: {
                    display: false,
                    grid: { display: false },
                    stacked: true
                },
                y: {
                    beginAtZero: true,
                    max: max,
                    display: false,
                    grid: { display: false },
                    stacked: true
                }
            }
        }
    });
}

  // --- FUNCIÓN 3: GRÁFICO DE GAUGE (Para TDS) ---
function updateGaugeChart(canvasId, textId, label, value, max = 5000, color) {
    if (value > max) { value = max; }
    if (value < 0) { value = 0; }

    const textElement = document.getElementById(textId);
    if (textElement) {
        textElement.innerText = value.toFixed(0);
    }

    const data = { 
        labels: [label, 'Restante'],
        datasets: [{
            data: [value, max - value],
            backgroundColor: [
                color,
                document.documentElement.classList.contains('dark') ? '#374151' : '#f3f4f6'
            ],
            borderWidth: 0,
            circumference: 180,
            rotation: 270
        }]
    };

    const canvasElement = document.getElementById(canvasId);
    if (!canvasElement) return;
    const ctx = canvasElement.getContext('2d');

    if (statCharts[canvasId]) {
        statCharts[canvasId].destroy();
    }

    statCharts[canvasId] = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '80%',
            plugins: {
                legend: { display: false },
                tooltip: { enabled: false },
                gaugeNeedle: { enable: true, max: max }
            }
        }
    });
}


// --- FUNCIÓN 4: FOCO DINÁMICO (Luz Encendida/Apagada) ---
function updateFocoLuz(luzValue) {
    const icon = document.getElementById('iconLuz');
    const estado = document.getElementById('estadoLuz');
    if (!icon || !estado) return;

    if (luzValue === 1) {
        // 💡 Encendido
        icon.style.stroke = '#facc15'; // Amarillo brillante
        icon.style.filter = 'drop-shadow(0 0 12px #facc15)';
        icon.style.opacity = '1';
        estado.textContent = 'Encendida';
        estado.style.color = '#facc15';
    } else {
        // ⚫ Apagado
        icon.style.stroke = '#9ca3af'; // Gris
        icon.style.filter = 'none';
        icon.style.opacity = '0.4';
        estado.textContent = 'Apagada';
        estado.style.color = '#9ca3af';
    }
}




    
    // --- FUNCIÓN 4: GRÁFICO DE PASTEL (Para Luz) ---
    function updatePieChartLuz(canvasId, textId, luzValue) {
        
        const textElement = document.getElementById(textId);
        if(textElement) {
            textElement.innerText = (luzValue === 1) ? 'ON' : 'OFF';
        }

        const data = {
            labels: ['Encendida', 'Apagada'],
            datasets: [{
                data: [luzValue * 100, (1 - luzValue) * 100],
                backgroundColor: [
                    'rgb(234, 179, 8)', // Amarillo para ON
                    document.documentElement.classList.contains('dark') ? '#4b5563' : '#e5e7eb'
                ],
                borderWidth: 0
            }]
        };

        const canvasElement = document.getElementById(canvasId);
        if (!canvasElement) return;
        const ctx = canvasElement.getContext('2d');
        if (statCharts[canvasId]) {
            statCharts[canvasId].destroy();
        }
        statCharts[canvasId] = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { enabled: false } }
            }
        });
    }

    
    // --- FUNCIÓN "CONTROLADORA": Dibuja los gráficos ---
    function drawStatCharts(lectura) {
        if (!lectura) return;

        setTimeout(() => {
            let tempMax = 40;
            let humMax = 100;
            let tdsMax = 5000; 

            updateDonutChart('statChartTempAgua', 'textChartTempAgua', 'Temp. Agua', lectura.temp_agua, tempMax, 'rgb(59, 130, 246)', '°C');
            updateDonutChart('statChartTempAmb', 'textChartTempAmb', 'Temp. Amb.', lectura.temp_ambiente, tempMax, 'rgb(249, 115, 22)', '°C');
            updateVerticalBarChart('statChartHumedad', 'textChartHumedad', 'Humedad', lectura.humedad, humMax, 'rgb(6, 182, 212)', '%');
            
            // --- ¡¡LLAMADA CORRECTA!! ---
            updateGaugeChart('statChartTDS', 'textChartTDS', 'TDS', lectura.tds, tdsMax, 'rgb(34, 197, 94)');
            
            updateFocoLuz(lectura.luz);

            
        }, 10);
      

    }

    // Limpieza de gráficos
    document.addEventListener('alpine:navigated', () => {
         const urlParams = new URLSearchParams(window.location.search);
         const currentTab = urlParams.get('tab') || 'dashboard'; 
         if (currentTab !== 'dashboard') {
             Object.values(statCharts).forEach(chart => {
                 if (chart) chart.destroy();
             });
             statCharts = {};
         }
     });
</script>




</div>