<?php

namespace App\Livewire\Prediccion;

use Livewire\Component;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\DB;

class AcuarioPrediccion extends Component
{
    // Variables de Datos
    public $proyecciones = null;       
    public $ultimoRegistro = null; 
    public $ultimaActualizacion = null; 
    public $cargando = false;          
    
    // Variables del Simulador Manual
    public $temperatura;
    public $resultado;
    public $metricas;
    public $error;

    public function mount()
    {
        $this->obtenerMetricasModelo();
        $this->actualizarProyecciones();
    }

    public function actualizarProyecciones()
    {
        $this->cargando = true;

        // 1. OBTENER DATOS (Toda la historia para Python)
        $datos = DB::table('prueba')
                    ->orderBy('fecha', 'desc') 
                    ->limit(500)
                    ->get();

        if ($datos->isEmpty()) {
            $this->proyecciones = ['error' => 'La tabla "prueba" está vacía.'];
            $this->cargando = false;
            return;
        }

        // 2. CAPTURAR EL ÚLTIMO REGISTRO (El "AHORA")
        $this->ultimoRegistro = $datos->first(); 

        // 3. EXPORTAR A CSV (EL "PUENTE")
        $csvPath = storage_path('app/python/datos_para_python.csv');
        $handle = fopen($csvPath, 'w');
        fputcsv($handle, ['created_at', 'temperatura_agua', 'temperatura_ambiente', 'humedad', 'tds']);

        foreach ($datos as $fila) {
            fputcsv($handle, [
                $fila->fecha,            
                $fila->temp_agua ?? 0,   
                $fila->temp_ambiente ?? 0, 
                $fila->humedad ?? 0,
                $fila->tds ?? 0
            ]);
        }
        fclose($handle);

        // 4. EJECUTAR PYTHON
        $pathScript = storage_path('app/python/proyeccion_futura.py');
        $rutaPython = "C:\\Users\\Erik\\AppData\\Local\\Programs\\Python\\Python39\\python.exe"; 

        $process = new Process([$rutaPython, $pathScript]);
        $process->setEnv([
            'SYSTEMROOT' => getenv('SYSTEMROOT'), 
            'PATH' => getenv('PATH'),
            'TEMP' => getenv('TEMP')
        ]);
        $process->setWorkingDirectory(storage_path('app/python'));
        $process->run();

        if ($process->isSuccessful()) {
            $this->proyecciones = json_decode($process->getOutput(), true);
            $this->ultimaActualizacion = now()->format('H:i:s');
        } else {
            $this->proyecciones = ['error' => 'Error Python: ' . $process->getErrorOutput()];
        }

        $this->cargando = false;
    }

    // --- LÓGICA DEL SIMULADOR MANUAL ---
    public function obtenerMetricasModelo()
    {
        $output = $this->ejecutarPythonGenerico(['info']);
        if ($output && !isset($output['error'])) {
            $this->metricas = $output;
        }
    }

    public function predecir()
    {
        $this->validate(['temperatura' => 'required|numeric']);
        $output = $this->ejecutarPythonGenerico(['predecir', $this->temperatura]);

        if (isset($output['prediccion'])) {
            $this->resultado = $output['prediccion'];
            $this->error = null;
        } else {
            $this->error = "Error al calcular.";
        }
    }

    private function ejecutarPythonGenerico($argumentos)
    {
        $pathScript = storage_path('app/python/predecir_livewire.py');
        $rutaPython = "C:\\Users\\Erik\\AppData\\Local\\Programs\\Python\\Python39\\python.exe";
        $comando = array_merge([$rutaPython, $pathScript], $argumentos);
        
        $process = new Process($comando);
        $process->setEnv(['SYSTEMROOT' => getenv('SYSTEMROOT'), 'PATH' => getenv('PATH'), 'TEMP' => getenv('TEMP')]);
        $process->setWorkingDirectory(storage_path('app/python'));
        $process->run();

        if (!$process->isSuccessful()) { return ['error' => $process->getErrorOutput()]; }
        return json_decode($process->getOutput(), true);
    }

    public function render()
    {
        return view('livewire.prediccion.acuario-prediccion')->layout('layouts.app');
    }
}