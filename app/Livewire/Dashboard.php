<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Prueba; // Asegúrate que tu modelo se llama así
use Livewire\WithPagination;
use Livewire\Attributes\Url; // Necesario para leer la URL

class Dashboard extends Component
{
    use WithPagination;

    #[Url(as: 'tab', keep: true)] 
    public $activeTab = 'dashboard'; // Valor por defecto si no hay parámetro

    // Propiedades para los filtros
    public $filtroFechaDesde;
    public $filtroFechaHasta;
    public $filtroLuz = ''; // '' significa "Todos"

    // NUEVO: Propiedad pública para los datos de los mini-gráficos
    public $dashboardChartData;

    /**
     * Resetea la paginación si cambia un filtro EN LA PESTAÑA HISTORIAL
     */
    public function updating($property)
    {
        // Solo resetea si estamos en la pestaña historial Y cambia un filtro
        if ($this->activeTab == 'historial' && in_array($property, ['filtroFechaDesde', 'filtroFechaHasta', 'filtroLuz'])) {
            $this->resetPage();
        }
    }

    /**
     * Renderiza el componente
     */
    public function render()
    {
        // Variables
        $lecturaActual = null;
        $historial = null; 

        // --- 1. Obtener la última lectura ---
        $lecturaActual = Prueba::orderBy('fecha', 'desc')->first();

        // --- 2. Lógica específica por pestaña ---
        
        // --- PESTAÑA DASHBOARD ---
        if ($this->activeTab == 'dashboard' && $lecturaActual) {
            
            // Preparamos datos simples para los gráficos pequeños
            $data = [
                'labels' => ['Temp. Agua', 'Temp. Ambiente'],
                'temperatures' => [$lecturaActual->temp_agua, $lecturaActual->temp_ambiente],
                'lightStatus' => [$lecturaActual->luz == 1 ? 1 : 0, $lecturaActual->luz == 0 ? 1 : 0], // [ON, OFF]
                'humidity' => [$lecturaActual->humedad, 100 - $lecturaActual->humedad], // [Actual, Restante]
                'tdsValue' => $lecturaActual->tds // Valor directo
            ];

            // NUEVO: Asigna los datos a la propiedad pública. 
            // Livewire los sincronizará automáticamente con Alpine.
            $this->dashboardChartData = $data;

            // ELIMINADO: Ya no despachamos el evento para los mini-gráficos.
        }

        // --- PESTAÑA GRÁFICOS ---
        elseif ($this->activeTab == 'charts') {
            // Query Base para FILTROS
            $chartQuery = Prueba::orderBy('fecha', 'desc'); 
            if ($this->filtroFechaDesde) {
                 $chartQuery->where('fecha', '>=', $this->filtroFechaDesde . ' 00:00:00');
            }
            if ($this->filtroFechaHasta) {
                 $chartQuery->where('fecha', '<=', $this->filtroFechaHasta . ' 23:59:59');
            }
            if ($this->filtroLuz !== '') {
                 $chartQuery->where('luz', $this->filtroLuz);
            }

            // Tomamos los últimos 100 registros
            $chartReadings = $chartQuery->limit(100)->get(); 

            // Formateamos los datos para Chart.js
            $chartLabels = $chartReadings->pluck('fecha')->map(fn($date) => $date->format('d/m H:i'));
            $chartTempAgua = $chartReadings->pluck('temp_agua');
            $chartTempAmb = $chartReadings->pluck('temp_ambiente');
            $chartHumedad = $chartReadings->pluck('humedad');
            $chartTDS = $chartReadings->pluck('tds');
            $chartLuz = $chartReadings->pluck('luz'); // 0 o 1

            // Enviamos el evento para actualizar los gráficos grandes (esto está bien)
            $this->dispatch('updateChart', 
                labels: $chartLabels, 
                tempAgua: $chartTempAgua, 
                tempAmb: $chartTempAmb,
                humedad: $chartHumedad,
                tds: $chartTDS,       
                luz: $chartLuz        
            );
        }
        
        // --- PESTAÑA HISTORIAL ---
        elseif ($this->activeTab == 'historial') {
            // Query Base para FILTROS y Paginación
            $historialQuery = Prueba::orderBy('fecha', 'desc');

            if ($this->filtroFechaDesde) {
                $historialQuery->where('fecha', '>=', $this->filtroFechaDesde . ' 00:00:00');
            }
            if ($this->filtroFechaHasta) {
                $historialQuery->where('fecha', '<=', $this->filtroFechaHasta . ' 23:59:59');
            }
            if ($this->filtroLuz !== '') {
                $historialQuery->where('luz', $this->filtroLuz);
            }
            
            // Aplicamos paginación
            $historial = $historialQuery->paginate(10); 
        }

        // --- 3. Renderizar la vista ---
        return view('livewire.dashboard', [
            'lecturaActual' => $lecturaActual,
            'historial' => $historial,
            // 'dashboardChartData' se sincroniza automáticamente
        ]);
    }
}