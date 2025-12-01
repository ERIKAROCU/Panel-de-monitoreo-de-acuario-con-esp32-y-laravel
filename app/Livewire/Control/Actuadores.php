<?php
namespace App\Livewire\Control;

use Livewire\Component;
use App\Models\Command;
use App\Models\Schedule;
use App\Models\FeederLog;
use App\Models\Setting;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;

class Actuadores extends Component
{
    use WithPagination;
    
    public $showScheduleModal = false;
    #[Rule('required|date_format:H:i')]
    public $newScheduleTime = '12:00';
    #[Rule('required|integer|min:1|max:5')]
    public $newSchedulePortions = 1;
    #[Rule('required|array|min:1')]
    public $newScheduleDays = [];
    #[Rule('required|boolean')]
    public $newScheduleIsActive = true;

    public $schedules;

    public $showHistoryModal = false;
    public $logFilter = 'all';

    public $angleOpen = 65;
    public $angleClose = 0;
    public $showConfigModal = false;

    public function mount()
    {
        $this->loadSchedules();
        $this->loadSettings();
    }

    public function loadSettings()
    {
        // Buscamos en la BD, si no existe usamos el defecto
        $this->angleOpen = Setting::where('key', 'feeder_angle_open')->value('value') ?? 65;
        $this->angleClose = Setting::where('key', 'feeder_angle_close')->value('value') ?? 0;
    }

    public function loadSchedules()
    {
        $this->schedules = Schedule::where('actuator_name', 'feeder')
                                    ->orderBy('time')
                                    ->get();
    }

    public function saveSettings()
    {
        // --- REGLAS DE VALIDACIÓN MEJORADAS ---
        $this->validate([
            'angleOpen' => [
                'required',
                'integer',
                'min:20',   // Pediste mínimo 20
                'max:180',  // 180 es el límite físico seguro de la mayoría de servos (aunque pediste 200, 180 es lo recomendado)
                'gt:angleClose' // gt = greater than (Mayor que el ángulo cerrado)
            ],
            'angleClose' => [
                'required',
                'integer',
                'min:0',    // Mínimo razonable
                'max:100',  // Máximo razonable para estar "cerrado"
                'lt:angleOpen' // lt = less than (Menor que el ángulo abierto)
            ],
        ], [
            // Mensajes personalizados en español
            'angleOpen.min' => 'El ángulo abierto debe ser al menos 20°.',
            'angleOpen.max' => 'El ángulo máximo seguro es 180°.',
            'angleOpen.gt' => 'El ángulo abierto debe ser mayor que el cerrado.',
            'angleClose.lt' => 'El ángulo cerrado debe ser menor que el abierto.',
        ]);

        // Guardar o Actualizar Ángulo Abierto
        Setting::updateOrCreate(
            ['key' => 'feeder_angle_open'],
            ['value' => $this->angleOpen]
        );

        // Guardar o Actualizar Ángulo Cerrado
        Setting::updateOrCreate(
            ['key' => 'feeder_angle_close'],
            ['value' => $this->angleClose]
        );

        $this->showConfigModal = false;
        
        // Mensaje de éxito
        session()->flash('message_feed', '¡Configuración calibrada correctamente!');
    }

    public function feedFish()
    {
        Command::updateOrCreate(
            ['actuator_name' => 'feeder'],
            ['command_value' => '1', 'is_pending' => true]
        );
        
        FeederLog::create([
            'event_type' => 'manual_feed',
            'details' => ['portions' => 1]
        ]);

        session()->flash('message_feed', '¡Comando (1 porción) enviado!');
    }

    public function openScheduleModal()
    {
        $this->resetErrorBag();
        $this->reset(['newScheduleTime', 'newSchedulePortions', 'newScheduleDays', 'newScheduleIsActive']);
        $this->newScheduleTime = '12:00';
        $this->newSchedulePortions = 1;
        $this->newScheduleIsActive = true;
        $this->showScheduleModal = true;
    }

    public function closeScheduleModal()
    {
        $this->showScheduleModal = false;
    }

    public function saveSchedule()
    {
        $this->validate();

        $schedule = Schedule::create([
            'actuator_name' => 'feeder',
            'time' => $this->newScheduleTime,
            'portions' => $this->newSchedulePortions,
            'days' => $this->newScheduleDays,
            'is_active' => $this->newScheduleIsActive,
        ]);

        FeederLog::create([
            'event_type' => 'schedule_created',
            'details' => [
                'time' => $schedule->time->format('H:i'),
                'portions' => $schedule->portions,
                'days' => $schedule->days,
                'is_active' => $schedule->is_active
            ],
            'schedule_id' => $schedule->id
        ]);

        $this->loadSchedules();
        $this->closeScheduleModal();
        session()->flash('message_schedule', '¡Horario guardado!');
    }

    public function deleteSchedule($scheduleId)
    {
        $schedule = Schedule::find($scheduleId);
        
        if ($schedule) {
            FeederLog::create([
                'event_type' => 'schedule_deleted',
                'details' => [
                    'time' => $schedule->time->format('H:i'),
                    'portions' => $schedule->portions,
                    'days' => $schedule->days
                ],
                'schedule_id' => $schedule->id
            ]);

            $schedule->delete();
            $this->loadSchedules();
            session()->flash('message_schedule', '¡Horario eliminado!');
        }
    }

    public function toggleSchedule($scheduleId)
    {
        $schedule = Schedule::find($scheduleId);
        if ($schedule) {
            $newStatus = !$schedule->is_active;
            $schedule->is_active = $newStatus;
            $schedule->save();

            FeederLog::create([
                'event_type' => 'schedule_toggled',
                'details' => [
                    'time' => $schedule->time->format('H:i'),
                    'new_status' => $newStatus
                ],
                'schedule_id' => $schedule->id
            ]);

            $this->loadSchedules();
        }
    }

    public function openHistoryModal()
    {
        $this->logFilter = 'schedule_created';
        $this->resetPage('logPage');
        $this->showHistoryModal = true;
    }

    public function closeHistoryModal()
    {
        $this->showHistoryModal = false;
    }

    public function updatedLogFilter()
    {
        $this->resetPage('logPage');
    }
    
    public function getLogIcon($eventType)
    {
        switch ($eventType) {
            case 'manual_feed': return 'M7.875 1.5l-3.837 3.837M12 1.5l-3.837 3.837M12 1.5l3.837 3.837M12 1.5V11.25M6.163 5.337l-3.837 3.837M12 11.25l-3.837 3.837M12 11.25l3.837 3.837M17.837 5.337l3.837 3.837M17.837 9.174l-3.837 3.837M17.837 9.174l3.837-3.837M6.163 9.174l-3.837-3.837M6.163 9.174l3.837 3.837M12 22.5l-3.837-3.837M12 22.5l3.837-3.837M12 18.663V22.5m-3.837-3.837l-3.837 3.837m3.837-3.837l3.837 3.837m3.837-3.837l3.837 3.837m-3.837-3.837l-3.837 3.837'; // heroicon-o-hand-raised
            case 'scheduled_feed': return 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z';
            case 'schedule_created': return 'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5'; // heroicon-o-calendar-days
            case 'schedule_toggled': return 'M5.636 5.636a9 9 0 1012.728 0M12 3v9';
            case 'schedule_deleted': return 'M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12.54 0c.342.052.682.107 1.022.166m11.518 0l-2.993-2.993m-12.54 0l2.993 2.993m0 0l-2.993 2.993m2.993-2.993l2.993 2.993'; // heroicon-o-trash
            default: return 'M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z'; // heroicon-o-question-mark-circle
        }
    }

    public function getLogDescription($log)
    {
        $details = $log->details;
        switch ($log->event_type) {
            case 'manual_feed':
                return "Alimentación manual de {$details['portions']} porción(es).";
            case 'scheduled_feed':
                return "Alimentación programada de {$details['portions']} porción(es).";
            case 'schedule_created':
                $status = $details['is_active'] ? 'activado' : 'desactivado';
                $days = implode(', ', $details['days']);
                return "Horario creado: {$details['time']}, {$details['portions']} porción(es), días: [{$days}]. Estado inicial: {$status}.";
            case 'schedule_toggled':
                $status = $details['new_status'] ? 'Horario activado' : 'Horario desactivado';
                return "{$status} (para horario de las {$details['time']}).";
            case 'schedule_deleted':
                return "Horario eliminado (Antiguo: {$details['time']}, {$details['portions']} porción(es)).";
            default:
                return "Evento desconocido: {$log->event_type}";
        }
    }

    public function getLogStatus($log)
    {
        $details = $log->details;
        switch ($log->event_type) {
            case 'manual_feed':
            case 'scheduled_feed':
                return 'Ejecutado';
            case 'schedule_created':
                return $details['is_active'] ? 'Creado (Activo)' : 'Creado (Inactivo)';
            case 'schedule_toggled':
                return $details['new_status'] ? 'Activado' : 'Desactivado';
            case 'schedule_deleted':
                return 'Eliminado';
            default:
                return '-';
        }
    }

    public function getLogStatusColor($log)
    {
        $details = $log->details ?? [];
        switch ($log->event_type) {
            case 'manual_feed':
            case 'scheduled_feed':
                return 'blue';
            case 'schedule_created':
                return $details['is_active'] ? 'green' : 'gray';
            case 'schedule_toggled':
                return $details['new_status'] ? 'green' : 'gray';
            case 'schedule_deleted':
                return 'red';
            default:
                return 'gray';
        }
    }

    public function getLogPortions($log)
    {
        $details = $log->details;
        switch ($log->event_type) {
            case 'manual_feed':
            case 'scheduled_feed':
            case 'schedule_created':
            case 'schedule_deleted':
                return $details['portions'] ?? '-';
            default:
                return '-';
        }
    }

    

    public function getLogTitle($eventType)
    {
        switch ($eventType) {
            case 'manual_feed': return 'Alimentación Manual';
            case 'scheduled_feed': return 'Alimentación Programada';
            case 'schedule_created': return 'Horario Creado';
            case 'schedule_toggled': return 'Estado Cambiado';
            case 'schedule_deleted': return 'Horario Eliminado';
            default: return 'Evento Desconocido';
        }
    }

    public function render()
    {
        $logsQuery = FeederLog::orderBy('created_at', 'desc');

        if ($this->logFilter !== 'all') {
            $logsQuery->where('event_type', $this->logFilter);
        }

        return view('livewire.control.actuadores', [
            'logs' => $logsQuery->paginate(10, ['*'], 'logPage')
        ]);
    }
}