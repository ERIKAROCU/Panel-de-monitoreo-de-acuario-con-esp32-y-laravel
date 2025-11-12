<?php

namespace App\Livewire\Control;

use Livewire\Component;
use App\Models\Prueba;
use Livewire\WithPagination;

// --- AÑADIR ESTAS DOS LÍNEAS ---
use App\Exports\HistorialExport;
use Maatwebsite\Excel\Facades\Excel;
// --- FIN ---

class Historial extends Component
{
    use WithPagination;

    // Propiedades para los filtros
    public $filtroFechaDesde;
    public $filtroFechaHasta;
    public $filtroLuz = ''; // '' significa "Todos"

    /**
    * Resetea la paginación si cambia un filtro
    */
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

        // Pasamos los filtros actuales al constructor del Export
        // Laravel Excel se encargará de la descarga
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