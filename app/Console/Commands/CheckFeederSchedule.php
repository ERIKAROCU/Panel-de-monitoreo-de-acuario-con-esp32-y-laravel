<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Schedule; // Importamos tu modelo de horarios
use App\Models\Command as AcuarioCommand; // Importamos tu modelo de comandos (renombrado para evitar conflictos)
use Carbon\Carbon;

class CheckFeederSchedule extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'acuario:check-schedule';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Revisa la tabla de horarios y activa el alimentador si es necesario';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 1. Obtener la hora y día actual (ya usa la zona horaria de config/app.php)
        $now = Carbon::now();
        $currentTime = $now->format('H:i'); // Ej: "14:30"
        
        // Obtenemos el día de la semana en español, minúsculas (ej: "lunes")
        $currentDay = strtolower($now->locale('es')->isoFormat('dddd'));

        $this->info("Revisando horarios para: $currentTime - $currentDay");

        // 2. Buscar si *existe* algún horario que coincida
        $scheduleExists = Schedule::where('time', $currentTime)
                                    ->whereJsonContains('days', $currentDay)
                                    ->exists();

        // 3. Si existe, activar el comando "FEED"
        if ($scheduleExists) {
            $this->info("¡Horario encontrado! Activando alimentador...");
            
            AcuarioCommand::updateOrCreate(
                ['actuator_name' => 'feeder'],
                [
                    'command_value' => 'FEED',
                    'is_pending'    => true
                ]
            );
            
            $this->info("Comando 'FEED' enviado.");
        
        } else {
            $this.info("Sin horarios coincidentes.");
        }

        return 0;
    }
}
