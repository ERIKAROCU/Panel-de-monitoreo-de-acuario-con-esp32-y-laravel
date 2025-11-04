<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Command;

class AcuarioController extends Controller
{
    public function checkCommands()
    {
        // 1. Busca un comando pendiente para el 'feeder'
        $command = Command::where('actuator_name', 'feeder')
                          ->where('is_pending', true)
                          ->first();

        if ($command) {
            // 2. Si existe, lo marca como "no pendiente"
            $command->is_pending = false;
            $command->save();

            // 3. Devuelve el comando al ESP32
            return response()->json([
                'command' => $command->command_value // Ej: "FEED"
            ]);
        }

        // 4. Si no hay nada, devuelve "NONE"
        return response()->json([
            'command' => 'NONE'
        ]);
    }
}
