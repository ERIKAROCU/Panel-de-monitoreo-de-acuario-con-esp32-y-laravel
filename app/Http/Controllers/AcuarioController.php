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
use App\Models\Prueba;

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
        $lightStatus = Setting::where('key', 'light_status')->value('value') ?? 0;
                          
        $response = [
            'light_status' => (int)$lightStatus, // El ESP32 leerá esto siempre
            'conf_open'    => (int)$angleOpen,
            'conf_close'   => (int)$angleClose
        ];

        if ($command) {
            $command->is_pending = false;
            $command->save();
            
            $response['command'] = $command->command_value; // Ejemplo: "3" porciones
        } else {
            $response['command'] = "NONE";
        }

        return response()->json($response);
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


    public function storeSensorLog(Request $request)
    {
        // Validamos que lleguen los datos
        $validated = $request->validate([
            'humedad'       => 'required|numeric',
            'temp_ambiente' => 'required|numeric',
            'temp_agua'     => 'required|numeric',
            'tds'           => 'nullable|numeric',
            'luz'           => 'required|boolean', // 0 o 1
        ]);

        // Guardamos en la Base de Datos
        Prueba::create([
            'humedad'       => $validated['humedad'],
            'temp_ambiente' => $validated['temp_ambiente'], 
            'temp_agua'     => $validated['temp_agua'],    
            'tds'           => $validated['tds'] ?? 0,
            'luz'           => $validated['luz'],
        ]);

        return response()->json(['status' => 'Saved'], 201);
    }
}