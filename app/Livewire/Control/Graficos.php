<?php

namespace App\Livewire\Control;

use Livewire\Component;
use App\Models\Prueba;

class Graficos extends Component
{
    // Propiedades para los filtros
    public $filtroFechaDesde;
    public $filtroFechaHasta;
    public $filtroLuz = ''; // '' significa "Todos"

    // Este método se llama cuando el componente 'lazy' se carga
    public function placeholder()
    {
        // Muestra un esqueleto de carga
        return view('livewire.placeholders.graficos-skeleton');
    }

    public function render()
    {
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

        // Tomamos los últimos 100 registros (o los que cumplan el filtro)
        $chartReadings = $chartQuery->limit(100)->get()->reverse(); // reverse() para que el gráfico vaya de izq a der

        // Formateamos los datos para Chart.js
        $chartLabels = $chartReadings->pluck('fecha')->map(fn($date) => $date->format('d/m H:i'));
        $chartTempAgua = $chartReadings->pluck('temp_agua');
        $chartTempAmb = $chartReadings->pluck('temp_ambiente');
        $chartHumedad = $chartReadings->pluck('humedad');
        $chartTDS = $chartReadings->pluck('tds');
        $chartLuz = $chartReadings->pluck('luz'); // 0 o 1

        // Enviamos el evento para actualizar los gráficos grandes
        // Usamos dispatch en lugar de entangle para data grande
        $this->dispatch('updateChart',
            labels: $chartLabels,
            tempAgua: $chartTempAgua,
            tempAmb: $chartTempAmb,
            humedad: $chartHumedad,
            tds: $chartTDS,
            luz: $chartLuz
        );
        
        return view('livewire.control.graficos');
    }
}
