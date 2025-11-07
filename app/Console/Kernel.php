<?php

namespace App\Console;

// Importa tu nuevo comando en la parte de arriba
use App\Console\Commands\CheckFeederSchedule; 

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        CheckFeederSchedule::class, // <-- AÑADE TU COMANDO AQUÍ
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        // AÑADE ESTA LÍNEA:
        // Esto le dice a Laravel que ejecute tu comando cada minuto.
        $schedule->command('acuario:check-schedule')->everyMinute();
    }
}