<?php

namespace App\Livewire\Control;

use Livewire\Component;
use App\Models\Command;
use App\Models\Schedule;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;

class Actuadores extends Component
{
    use WithPagination;
    
    // --- Propiedades para el Modal de Programación ---
    public $showScheduleModal = false;

    #[Rule('required|date_format:H:i')]
    public $newScheduleTime = '12:00';

    #[Rule('required|integer|min:1|max:5')]
    public $newSchedulePortions = 1;

    #[Rule('required|array|min:1')]
    public $newScheduleDays = [];

    // --- ¡NUEVA PROPIEDAD! ---
    #[Rule('required|boolean')]
    public $newScheduleIsActive = true; // Por defecto está activo

    // --- Propiedad para la lista ---
    public $schedules;

    public function mount()
    {
        $this->loadSchedules();
    }

    public function loadSchedules()
    {
        $this->schedules = Schedule::where('actuator_name', 'feeder')
                                    ->orderBy('time')
                                    ->get();
    }

    public function feedFish()
    {
        Command::updateOrCreate(
            ['actuator_name' => 'feeder'],
            ['command_value' => '1', 'is_pending' => true]
        );
        session()->flash('message_feed', '¡Comando (1 porción) enviado!');
    }

    // --- Métodos del Modal ---

    public function openScheduleModal()
    {
        $this->resetErrorBag();
        // Reseteamos todos los campos, incluido el nuevo
        $this->reset(['newScheduleTime', 'newSchedulePortions', 'newScheduleDays', 'newScheduleIsActive']);
        $this->newScheduleTime = '12:00';
        $this->newSchedulePortions = 1;
        $this->newScheduleIsActive = true; // Valor por defecto
        $this->showScheduleModal = true;
    }

    public function closeScheduleModal()
    {
        $this->showScheduleModal = false;
    }

    public function saveSchedule()
    {
        $this->validate();

        Schedule::create([
            'actuator_name' => 'feeder',
            'time' => $this->newScheduleTime,
            'portions' => $this->newSchedulePortions,
            'days' => $this->newScheduleDays,
            'is_active' => $this->newScheduleIsActive, // <-- ¡GUARDAMOS EL NUEVO CAMPO!
        ]);

        $this->loadSchedules();
        $this->closeScheduleModal();
        session()->flash('message_schedule', '¡Horario guardado!');
    }

    public function deleteSchedule($scheduleId)
    {
        Schedule::find($scheduleId)->delete();
        $this->loadSchedules();
        session()->flash('message_schedule', '¡Horario eliminado!');
    }

    // --- ¡NUEVA FUNCIÓN PARA EL INTERRUPTOR! ---
    public function toggleSchedule($scheduleId)
    {
        $schedule = Schedule::find($scheduleId);
        if ($schedule) {
            $schedule->is_active = !$schedule->is_active; // Invierte el valor
            $schedule->save();
            $this->loadSchedules(); // Actualiza la lista
        }
    }

    public function render()
    {
        return view('livewire.control.actuadores');
    }
}

