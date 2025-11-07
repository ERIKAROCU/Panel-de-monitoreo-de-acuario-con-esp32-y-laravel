<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Command;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log; // Asegúrate de que esto esté importado

class AcuarioController extends Controller
{
    /**
     * El ESP32 llama a esta función cada 3 segundos.
     */
    public function checkCommands()
    {
        // --- NUEVA LÓGICA DE PROGRAMACIÓN (SE EJECUTA 1 VEZ POR MINUTO REAL) ---

        // 1. Obtenemos la hora actual
        $now = Carbon::now(); 
        // 2. Obtenemos el minuto actual como un string único (ej: "09:14")
        $currentMinute = $now->format('H:i');
        
        // 3. Creamos un nombre de candado BASADO en ese minuto
        $lockName = 'acuario_schedule_check_' . $currentMinute;

        // 4. Intentamos obtener ese candado por 60 segundos
        // La primera vez que llame el ESP32 a las "09:14:02", obtendrá el candado "...._09:14".
        // Todas las demás llamadas en "09:14:XX" fallarán.
        // A las "09:15:01", el candado "...._09:15" será nuevo y se obtendrá.
        $lock = Cache::lock($lockName, 60);

        if ($lock->get()) {
            // ¡LOG ACTIVADO!
            Log::info("Cache lock '{$lockName}' obtenido. Revisando horarios...");
            // Pasamos las variables que ya calculamos para no hacerlo dos veces
            $this->checkAndTriggerSchedule($currentMinute, $now);
        }

        // --- Lógica de Comandos (se ejecuta cada 3 segundos) ---
        
        $command = Command::where('actuator_name', 'feeder')
                          ->where('is_pending', true)
                          ->first();

        if ($command) {
            $command->is_pending = false;
            $command->save();
            return response()->json(['command' => $command->command_value]);
        }

        return response()->json(['command' => 'NONE']);
    }

    /**
     * Revisa la hora y el día.
     * Acepta $currentTime y $now para ser más eficiente.
     */
    private function checkAndTriggerSchedule($currentTime, $now)
    {
        // Ya no necesitamos calcular $now o $currentTime
        $currentDay = strtolower($now->locale('es')->isoFormat('dddd'));

        // ¡LOG ACTIVADO!
        Log::info("Revisando: $currentTime en $currentDay");

        // Usamos whereTime() para comparar 'H:i' con la columna 'time'
        $schedule = Schedule::where('is_active', true) 
                                    ->whereTime('time', $currentTime)
                                    ->whereJsonContains('days', $currentDay)
                                    ->first();

        if ($schedule) {
            // ¡LOG ACTIVADO!
            Log::info("¡Horario encontrado! Activando {$schedule->portions} porciones.");
            
            $portions = $schedule->portions; 

            Command::updateOrCreate(
                ['actuator_name' => 'feeder'],
                [
                    'command_value' => $portions,
                    'is_pending'    => true
                ]
            );
        } else {
             Log::info("No se encontró ningún horario coincidente.");
        }
    }
}