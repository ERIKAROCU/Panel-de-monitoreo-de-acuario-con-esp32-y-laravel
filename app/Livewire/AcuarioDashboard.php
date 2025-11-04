<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Prueba;
use Livewire\WithPagination; // Lo mantenemos por si un hijo lo necesita (aunque Historial lo importará)
use Livewire\Attributes\Url;

class AcuarioDashboard extends Component
{
    use WithPagination;

    #[Url(as: 'tab', keep: true)]
    public $activeTab = 'dashboard'; // Valor por defecto

    public function render()
    {
        // La única tarea del padre: obtener el estado más reciente
        $lecturaActual = Prueba::orderBy('fecha', 'desc')->first();

        return view('livewire.acuario-dashboard', [
            'lecturaActual' => $lecturaActual,
        ]);
    }
}
