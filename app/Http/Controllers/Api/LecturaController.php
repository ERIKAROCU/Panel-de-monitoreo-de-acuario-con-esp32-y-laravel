<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prueba; // Importamos el modelo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Para validar datos

class LecturaController extends Controller
{
    /**
     * Almacena una nueva lectura de sensor en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Validar los datos que llegan por GET
        $validator = Validator::make($request->all(), [
            'humedad' => 'required|numeric',
            'temp_ambiente' => 'required|numeric',
            'temp_agua' => 'required|numeric',
            'tds' => 'required|integer',
            'luz' => 'required|integer|in:0,1',
        ]);

        // 2. Si la validación falla, devuelve un error
        // (Tu ESP32 verá esto como un error HTTP 400)
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Datos inválidos',
                'errors' => $validator->errors()
            ], 400);
        }

        // 3. Si todo está bien, crea el registro
        try {
            Prueba::create([
                'humedad' => $request->humedad,
                'temp_ambiente' => $request->temp_ambiente,
                'temp_agua' => $request->temp_agua,
                'tds' => $request->tds,
                'luz' => $request->luz,
            ]);

            // 4. Responde al ESP32 con éxito
            return response()->json(['message' => '✅ Datos guardados correctamente'], 201);

        } catch (\Exception $e) {
            // 5. Captura cualquier error de la base de datos
            return response()->json([
                'message' => '❌ Error al guardar en la BD',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}