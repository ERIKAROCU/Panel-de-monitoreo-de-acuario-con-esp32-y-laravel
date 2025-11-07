<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    /**
     * Los campos que se pueden llenar masivamente.
     */
    protected $fillable = [
        'actuator_name',
        'time',
        'portions',
        'days',
        'is_active',
    ];

    /**
     * Conversión automática de tipos (casting).
     * Convierte el JSON de la BD en un array de PHP y viceversa.
     */
    protected $casts = [
        'days' => 'array',
        'time' => 'datetime:H:i', // Guarda la hora
        'is_active' => 'boolean',
    ];
}
