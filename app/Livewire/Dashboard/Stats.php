<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Prueba;
use Livewire\Attributes\Reactive; // Importante para recibir la prop reactiva

class Stats extends Component
{
    // #[Reactive] asegura que esta propiedad se actualice
    // automáticamente cuando cambie en el padre (AcuarioDashboard)
    #[Reactive]
    public Prueba $lectura;

    // Propiedad para los datos de los mini-gráficos
    public $dashboardChartData;

    // Este hook se llama CADA VEZ que la data (incluida $lectura) se actualiza
    public function boot()
    {
        $this->prepareChartData();
    }

    public function prepareChartData()
    {
        if ($this->lectura) {
            $this->dashboardChartData = [
                'labels' => ['Temp. Agua', 'Temp. Ambiente'],
                'temperatures' => [$this->lectura->temp_agua, $this->lectura->temp_ambiente],
                'lightStatus' => [$this->lectura->luz == 1 ? 1 : 0, $this->lectura->luz == 0 ? 1 : 0], // [ON, OFF]
                'humidity' => [$this->lectura->humedad, 100 - $this->lectura->humedad], // [Actual, Restante]
                'tdsValue' => $this->lectura->tds // Valor directo
            ];
        }
    }

    public function render()
    {
        // Solo renderiza la vista. La data ya fue procesada en boot().
        return view('livewire.dashboard.stats');
    }
}
