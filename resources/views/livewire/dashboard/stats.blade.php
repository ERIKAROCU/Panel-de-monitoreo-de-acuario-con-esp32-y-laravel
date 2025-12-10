<div wire:poll.5s
    x-data="{}" 
    x-init="drawStatCharts({{ json_encode($lectura) }})"
    @actualizar-graficos.window="drawStatCharts($event.detail.lectura)"
>

  {{-- 🔹 Encabezado principal --}}
<div class="relative z-10 bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 flex flex-col items-center">
    <h2 class="text-md font-semibold text-gray-800 dark:text-gray-200">Dashboard</h2>
</div>
    
    {{-- =============== NUEVA FILA DE GRÁFICOS INTERPRETATIVOS =============== --}}
    <div wire:ignore class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 mt-10 mb-6">
        
        {{-- Temperatura Agua --}}
        <div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center">
                <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-3">Temp. Agua</h4>
                <div class="w-full h-48 relative">
                    <canvas id="statChartTempAgua"></canvas>
                    <div id="textChartTempAgua" 
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 
                                text-2xl font-bold text-gray-800 dark:text-gray-200"></div>
                </div>
            </div>
            <br>
            {{-- 🔹 LEYENDA ACTUALIZADA --}}
            <div id="leyendaTempAgua" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center justify-center min-h-[140px] text-center">
                </div>
        </div>
        
        {{-- Temperatura Ambiente --}}
        <div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center">
                <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-3">Temp. Ambiente</h4>
                <div class="w-full h-48 relative">
                    <canvas id="statChartTempAmb"></canvas>
                    <div id="textChartTempAmb" 
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 
                                text-2xl font-bold text-gray-800 dark:text-gray-200"></div>
                </div>
            </div>
            <br>
            {{-- 🔹 LEYENDA ACTUALIZADA --}}
            <div id="leyendaTempAmb" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center justify-center min-h-[140px] text-center">
                </div>
        </div>

        {{-- Humedad --}}
        <div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center">
                <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-3">Humedad</h4>
                <div class="w-full h-48 relative flex items-center justify-center">
                    <canvas id="statChartHumedad"></canvas>
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center space-y-1">
                        <div id="textChartHumedad" 
                            class="text-2xl font-bold text-gray-800 dark:text-gray-200"></div>
                    </div>
                </div>
            </div>
            <br>
            {{-- 🔹 LEYENDA ACTUALIZADA --}}
            <div id="leyendaHumedad" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center justify-center min-h-[140px] text-center">
                </div>
        </div>
        
        {{-- TDS --}}
        <div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center justify-center">
                {{-- 🔹 CAMBIO: Título actualizado --}}
                <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-3">TDS (Agua Fuente)</h4>

                {{-- 🔹 CAMBIO: Altura unificada a h-48 y w-full --}}
                <div class="relative w-full h-48 flex items-center justify-center"> 
                    <canvas id="statChartTDS" class="w-full h-full"></canvas>
                    <div id="textChartTDS" 
                        class="absolute top-1/2 left-1/2 
                                -translate-x-1/2 -translate-y-1/2
                                text-3xl font-bold text-gray-800 dark:text-gray-200"></div>
                </div>
            </div>
            <br>
            <div id="leyendaTDS" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center justify-center min-h-[140px] text-center">
                </div>
        </div>

        {{-- Luz --}}
        <div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center">
                <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-3">Nivel de Luz</h4>

                {{-- 🔹 CAMBIO: Altura unificada a h-48 y w-full (removido w-32 h-32) --}}
                <div id="textChartLuz"
                    class="relative flex flex-col items-center justify-center w-full h-48">
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
            <br>
            <div id="leyendaLuz" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center justify-center min-h-[140px] text-center">
                </div>
        </div>
    </div>
</div>

{{-- =============== SCRIPTS =============== --}}
<script src="https://unpkg.com/lucide@latest"></script>
<script>lucide.createIcons();</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    let statCharts = {};

    // --- PLUGIN: AGUJA DEL GAUGE (CON ETIQUETAS 0% Y 100%) ---
    // (Este plugin tuyo está bien, lo dejamos como estaba)
    const gaugeNeedle = {
    id: 'gaugeNeedle',
    afterDraw(chart, args, pluginOptions) {
        if (!pluginOptions.enable) return;

        const { ctx } = chart;
        const dataset = chart.data.datasets[0];
        const value = dataset.data[0];
        const max = pluginOptions.max || 5000; 

        const meta = chart.getDatasetMeta(0);
        if (!meta || !meta.data || !meta.data[0]) return;

        const centerX = meta.data[0].x;
        const centerY = meta.data[0].y;
        const outerRadius = meta.data[0].outerRadius;
        const innerRadius = meta.data[0].innerRadius;
        const needleRadius = (innerRadius + outerRadius) / 2;

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

    
    /**
     * 🔹 (HELPER) Función interna para crear/actualizar gráficos
     */
    function _createChart(canvasId, config) {
        const canvasElement = document.getElementById(canvasId);
        if (!canvasElement) return;
        const ctx = canvasElement.getContext('2d');
        
        if (statCharts[canvasId]) {
            statCharts[canvasId].destroy();
        }
        statCharts[canvasId] = new Chart(ctx, config);
    }


    /**
     * FUNCIÓN 1: GRÁFICO DE ANILLO (Para Temp y Humedad)
     */
    function updateDonutChart(canvasId, textId, label, value, max, color, unit) {
        if (value > max) { value = max; }
        if (value < 0) { value = 0; }
        
        const textElement = document.getElementById(textId);
        if(textElement) {
            let displayValue = (unit === '%') ? value.toFixed(0) : value.toFixed(1);
            textElement.innerText = displayValue + unit;
        }

        const data = {
            labels: [label, 'Restante'],
            datasets: [{
                data: [value, Math.max(0, max - value)],
                backgroundColor: [ color, document.documentElement.classList.contains('dark') ? '#374151' : '#f3f4f6' ],
                borderWidth: 0,
                circumference: 270,
                rotation: 225,
            }]
        };
        
        const config = {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '80%',
                plugins: { legend: { display: false }, tooltip: { enabled: false } }
            }
        };
        
        _createChart(canvasId, config);
    }

    /**
     * FUNCIÓN 2: GRÁFICO DE GAUGE (Para TDS)
     */
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
                data: [value, Math.max(0, max - value)],
                backgroundColor: [
                    color,
                    document.documentElement.classList.contains('dark') ? '#374151' : '#f3f4f6'
                ],
                borderWidth: 0,
                circumference: 180,
                rotation: 270
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '80%',
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false },
                    gaugeNeedle: { enable: true, max: max } // Pasa el max al plugin
                }
            }
        };

        _createChart(canvasId, config);
    }

    /**
     * FUNCIÓN 3: FOCO DINÁMICO (Luz Encendida/Apagada)
     */
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


    /**
     * 🔹 (NUEVO) FUNCIÓN 4: ACTUALIZA LAS LEYENDAS INTERPRETATIVAS
     */
    function updateLeyendas(lectura) {
        // --- 1. Leyenda Temp. Agua (para pecera tropical) ---
        const elTempAgua = document.getElementById('leyendaTempAgua');
        let estadoTempAgua = {};
        if (lectura.temp_agua < 23) {
            estadoTempAgua = { estado: 'Fría', color: 'text-blue-400', icono: 'thermometer-snowflake' };
        } else if (lectura.temp_agua <= 28) {
            estadoTempAgua = { estado: 'Óptima', color: 'text-green-400', icono: 'thermometer' };
        } else {
            estadoTempAgua = { estado: 'Caliente', color: 'text-red-400', icono: 'thermometer-sun' };
        }
        elTempAgua.innerHTML = `
            <i data-lucide="${estadoTempAgua.icono}" class="w-10 h-10 ${estadoTempAgua.color} mb-2"></i>
            <span class="font-semibold ${estadoTempAgua.color}">${estadoTempAgua.estado}</span>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Rango ideal: 23-28°C</p>
        `;

        // --- 2. Leyenda Temp. Ambiente ---
        const elTempAmb = document.getElementById('leyendaTempAmb');
        let estadoTempAmb = {};
        if (lectura.temp_ambiente < 18) {
            estadoTempAmb = { estado: 'Frío', color: 'text-blue-400', icono: 'thermometer-snowflake' };
        } else if (lectura.temp_ambiente <= 26) {
            estadoTempAmb = { estado: 'Templado', color: 'text-green-400', icono: 'thermometer' };
        } else {
            estadoTempAmb = { estado: 'Caluroso', color: 'text-red-400', icono: 'thermometer-sun' };
        }
        elTempAmb.innerHTML = `
            <i data-lucide="${estadoTempAmb.icono}" class="w-10 h-10 ${estadoTempAmb.color} mb-2"></i>
            <span class="font-semibold ${estadoTempAmb.color}">${estadoTempAmb.estado}</span>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Confort: 18-26°C</p>
        `;

        // --- 3. Leyenda Humedad Ambiente ---
        const elHumedad = document.getElementById('leyendaHumedad');
        let estadoHumedad = {};
        if (lectura.humedad < 30) {
            estadoHumedad = { estado: 'Seco', color: 'text-yellow-500', icono: 'wind' };
        } else if (lectura.humedad <= 60) {
            estadoHumedad = { estado: 'Confortable', color: 'text-green-400', icono: 'droplets' };
        } else {
            estadoHumedad = { estado: 'Húmedo', color: 'text-blue-400', icono: 'cloud-drizzle' };
        }
        elHumedad.innerHTML = `
            <i data-lucide="${estadoHumedad.icono}" class="w-10 h-10 ${estadoHumedad.color} mb-2"></i>
            <span class="font-semibold ${estadoHumedad.color}">${estadoHumedad.estado}</span>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Confort: 30-60%</p>
        `;

        // --- 4. Leyenda TDS (Agua dulce) ---
        const elTDS = document.getElementById('leyendaTDS');
        let estadoTDS = {};
        if (lectura.tds < 100) {
            estadoTDS = { estado: 'Muy Baja', color: 'text-cyan-400', icono: 'filter-x' };
        } else if (lectura.tds <= 600) {
            estadoTDS = { estado: 'Ideal', color: 'text-green-400', icono: 'check-circle' };
        } else if (lectura.tds <= 1000) {
            estadoTDS = { estado: 'Alta', color: 'text-yellow-500', icono: 'alert-triangle' };
        } else {
            estadoTDS = { estado: 'Peligrosa', color: 'text-red-400', icono: 'skull' };
        }
        elTDS.innerHTML = `
            <i data-lucide="${estadoTDS.icono}" class="w-10 h-10 ${estadoTDS.color} mb-2"></i>
            <span class="font-semibold ${estadoTDS.color}">${estadoTDS.estado} (ppm)</span>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Ideal : 600-1000</p>
        `;

        // --- 5. Leyenda Luz ---
        const elLuz = document.getElementById('leyendaLuz');
        let estadoLuz = {};
        if (lectura.luz === 1) {
            estadoLuz = { estado: 'Iluminación Activa', color: 'text-yellow-400', icono: 'sun' };
        } else {
            estadoLuz = { estado: 'Ciclo de Descanso', color: 'text-gray-400', icono: 'moon' };
        }
        elLuz.innerHTML = `
            <i data-lucide="${estadoLuz.icono}" class="w-10 h-10 ${estadoLuz.color} mb-2"></i>
            <span class="font-semibold ${estadoLuz.color}">${estadoLuz.estado}</span>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">${(lectura.luz === 1 ? "Día" : "Noche")}</p>
        `;

        // 🔹 ¡Importante! Renderiza los nuevos iconos de Lucide
        lucide.createIcons();
    }


    /**
     * FUNCIÓN "CONTROLADORA": Dibuja/Actualiza todos los gráficos
     */
    function drawStatCharts(lectura) {
        if (!lectura) return;

        // Usamos setTimeout para asegurar que Alpine haya procesado los cambios del DOM
        setTimeout(() => {
            let tempMax = 40;
            let humMax = 100;
            let tdsMax = 1800; // Ajustado a un máximo más realista (5000 es mucho)

            // --- Actualiza los Gráficos ---
            updateDonutChart('statChartTempAgua', 'textChartTempAgua', 'Temp. Agua', lectura.temp_agua, tempMax, 'rgb(59, 130, 246)', '°C');
            updateDonutChart('statChartTempAmb', 'textChartTempAmb', 'Temp. Amb.', lectura.temp_ambiente, tempMax, 'rgb(249, 115, 22)', '°C');
            
            // 🔹 ¡CAMBIO! Usamos updateDonutChart para la humedad
            updateDonutChart('statChartHumedad', 'textChartHumedad', 'Humedad', lectura.humedad, humMax, 'rgb(6, 182, 212)', '%');
            
            updateGaugeChart('statChartTDS', 'textChartTDS', 'TDS', lectura.tds, tdsMax, 'rgb(34, 197, 94)');
            updateFocoLuz(lectura.luz);
            
            // --- 🔹 (NUEVO) Actualiza las Leyendas ---
            updateLeyendas(lectura);

        }, 10);
    }

    // Limpieza de gráficos (sin cambios, esto está bien)
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