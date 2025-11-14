<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Prueba;

class Stats extends Component
{
    // 1. $lectura debe estar inicializada
    public Prueba $lectura;

    // 2. Añade mount() para la carga inicial
    public function mount()
    {
        // Carga la lectura inicial. Si la tabla está vacía,
        // $lectura será un nuevo modelo vacío (los valores serán null o 0)
        $this->lectura = Prueba::latest()->first() ?? new Prueba();
    }

    // 3. El listener ya no es necesario, wire:poll llamará a render()
    // protected $listeners = ['refreshLectura' => 'actualizarLectura'];
    // public function actualizarLectura() { ... } // <- Puedes borrar esta función

    public function render()
    {
        // 4. Obtén la última lectura cada vez que el componente se renderice (por el polling)
        $this->lectura = Prueba::latest()->first() ?? new Prueba();

        // 5. Envía los nuevos datos a Alpine/JS DESPUÉS de que el HTML se actualice
        //    Esto asegurará que los gráficos se sincronicen con las tarjetas.
        $this->dispatch('actualizarGraficos', lectura: $this->lectura);
        
        return view('livewire.dashboard.stats');
    }
}