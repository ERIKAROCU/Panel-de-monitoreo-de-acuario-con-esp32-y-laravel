<?php

namespace App\Livewire\Control;

use Livewire\Component;
use App\Models\Prueba;
use App\Models\Setting;
use Livewire\WithPagination;
use App\Exports\HistorialExport;
use Maatwebsite\Excel\Facades\Excel;

class Historial extends Component
{
    use WithPagination;

    public $filtroFechaDesde;
    public $filtroFechaHasta;
    public $filtroLuz = ''; 
    public $showConfigModal = false;
    public $sensorInterval = 60;
    public $sensorPaused = false;

    public function mount()
    {
        $this->loadSettings();
    }

    public function loadSettings()
    {
        $this->sensorInterval = Setting::where('key', 'sensor_interval')->value('value') ?? 60;
        $pausedValue = Setting::where('key', 'sensor_paused')->value('value') ?? 0;
        $this->sensorPaused = ($pausedValue == 1);
    }

    public function saveSettings()
    {
        $this->validate([
            'sensorInterval' => 'required|integer|min:5|max:3600', // Mínimo 5 seg, Máx 1 hora
            'sensorPaused'   => 'boolean'
        ]);

        // Guardar Intervalo
        Setting::updateOrCreate(
            ['key' => 'sensor_interval'],
            ['value' => $this->sensorInterval]
        );

        // Guardar Estado de Pausa (1 = Pausado, 0 = Activo)
        Setting::updateOrCreate(
            ['key' => 'sensor_paused'],
            ['value' => $this->sensorPaused ? 1 : 0]
        );

        $this->showConfigModal = false;
        
        // Mensaje flash opcional
        session()->flash('message_config', '¡Configuración de sensores actualizada!');
    }

    public function openConfigModal()
    {
        $this->loadSettings();
        $this->showConfigModal = true;
    }

    public function updating($property)
    {
        if (in_array($property, ['filtroFechaDesde', 'filtroFechaHasta', 'filtroLuz'])) {
            $this->resetPage();
        }
    }

    public function placeholder()
    {
        return view('livewire.placeholders.historial-skeleton');
    }

    public function render()
    {
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

        return view('livewire.control.historial', [
            'historial' => $historial,
        ]);
    }

    // --- AÑADIR ESTE NUEVO MÉTODO ---
    public function exportarExcel()
    {
        $fileName = 'historial_sensores_' . now()->format('Y-m-d_His') . '.xlsx';
        return Excel::download(
            new HistorialExport(
                $this->filtroFechaDesde, 
                $this->filtroFechaHasta, 
                $this->filtroLuz
            ), 
            $fileName
        );
    }
    // --- FIN ---
}