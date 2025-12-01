<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Command;
use App\Models\Schedule;
use App\Models\FeederLog;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AcuarioController extends Controller
{
    public function checkCommands()
    {
        $now = Carbon::now('America/Lima'); 

        $currentMinute = $now->format('H:i');
        
        $lockName = 'acuario_schedule_check_' . $currentMinute;
        $lock = Cache::lock($lockName, 60);

        if ($lock->get()) {
            $this->checkAndTriggerSchedule($currentMinute, $now);
        }
        
        $command = Command::where('actuator_name', 'feeder')
                          ->where('is_pending', true)
                          ->first();

        $angleOpen = Setting::where('key', 'feeder_angle_open')->value('value') ?? 65;
        $angleClose = Setting::where('key', 'feeder_angle_close')->value('value') ?? 0;
                          
        if ($command) {
            $command->is_pending = false;
            $command->save();
            return response()->json([
                'command' => $command->command_value,
                'conf_open' => (int)$angleOpen,   // Enviamos config
                'conf_close' => (int)$angleClose  // Enviamos config
            ]);
        }

        return response()->json(['command' => 'NONE']);
    }

    private function checkAndTriggerSchedule($currentTime, $now)
    {
        $englishDay = $now->format('l');
        
        $daysMap = [
            'Monday'    => 'lunes',
            'Tuesday'   => 'martes',
            'Wednesday' => 'miercoles',
            'Thursday'  => 'jueves',
            'Friday'    => 'viernes',
            'Saturday'  => 'sabado',
            'Sunday'    => 'domingo',
        ];

        $currentDay = $daysMap[$englishDay] ?? 'error';

        Log::info("DEBUG HORARIO: Hora Servidor: {$currentTime} | Día calculado: {$currentDay} | Buscando en BD...");

        $schedule = Schedule::where('is_active', true) 
                            ->where('time', $currentTime)
                            ->whereJsonContains('days', $currentDay)
                            ->first();

        if ($schedule) {
            Log::info("¡EXITO! Horario encontrado. ID: {$schedule->id}");
            
            $portions = $schedule->portions; 

            Command::updateOrCreate(
                ['actuator_name' => 'feeder'],
                [
                    'command_value' => $portions,
                    'is_pending'    => true
                ]
            );

            FeederLog::create([
                'event_type' => 'scheduled_feed',
                'details' => ['portions' => $portions],
                'schedule_id' => $schedule->id
            ]);

        } else {
             Log::info("FALLO: No hay coincidencia para {$currentTime} en {$currentDay}.");
        }
    }
}