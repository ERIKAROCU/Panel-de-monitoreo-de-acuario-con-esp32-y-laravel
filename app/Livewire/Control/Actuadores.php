<?php

namespace App\Livewire\Control;

use Livewire\Component;
use App\Models\Command; // Asegúrate de importar tu modelo Command

class Actuadores extends Component
{
    /**
     * Método llamado por el botón "Alimentar"
     */
    public function feedFish()
    {
        // Crea o actualiza el comando para el alimentador
        Command::updateOrCreate(
            ['actuator_name' => 'feeder'], // Busca por este nombre
            [
                'command_value' => 'FEED',   // Establece el comando
                'is_pending'    => true      // Lo marca como pendiente
            ]
        );
        
        // (Opcional) Puedes añadir un mensaje de éxito
        session()->flash('message', '¡Comando de alimentación enviado al ESP32!');
    }

    public function render()
    {
        return view('livewire.control.actuadores');
    }
}
