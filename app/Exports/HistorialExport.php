<?php

namespace App\Exports;

use App\Models\Prueba;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class HistorialExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $fechaDesde;
    protected $fechaHasta;
    protected $luz;

    /**
    * Constructor para recibir los filtros desde el componente Livewire
    */
    public function __construct($fechaDesde, $fechaHasta, $luz)
    {
        $this->fechaDesde = $fechaDesde;
        $this->fechaHasta = $fechaHasta;
        $this->luz        = $luz;
    }

    /**
    * Prepara la consulta a la base de datos aplicando los filtros.
    * Usamos FromQuery para que maneje grandes cantidades de datos eficientemente.
    */
    public function query()
    {
        // Es la MISMA lógica de tu componente Livewire
        $historialQuery = Prueba::orderBy('fecha', 'desc');

        if ($this->fechaDesde) {
            $historialQuery->where('fecha', '>=', $this->fechaDesde . ' 00:00:00');
        }
        if ($this->fechaHasta) {
            $historialQuery->where('fecha', '<=', $this->fechaHasta . ' 23:59:59');
        }
        if ($this->luz !== '') {
            $historialQuery->where('luz', $this->luz);
        }
        
        // Importante: No usamos ->paginate(), solo devolvemos la consulta
        return $historialQuery;
    }

    /**
    * Define la fila de encabezados en el Excel.
    */
    public function headings(): array
    {
        return [
            'Fecha y Hora',
            'T. Agua (°C)',
            'T. Ambiente (°C)',
            'Humedad (%)',
            'TDS',
            'Luz',
        ];
    }

    /**
    * Mapea (transforma) cada fila de datos antes de escribirla.
    * $lectura es una instancia del modelo Prueba.
    */
    public function map($lectura): array
    {
        return [
            $lectura->fecha->format('d/m/Y h:i:s A'),
            number_format($lectura->temp_agua, 1),
            number_format($lectura->temp_ambiente, 1),
            number_format($lectura->humedad, 1),
            $lectura->tds,
            $lectura->luz == 1 ? 'ON' : 'OFF', // Formateamos el 1/0 a ON/OFF
        ];
    }
}