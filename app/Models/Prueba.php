<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    use HasFactory;

    /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'prueba';

    /**
     * Indica al modelo que no use 'updated_at'.
     */
    const UPDATED_AT = null;

    /**
     * Indica al modelo que use 'fecha' en lugar de 'created_at'.
     */
    const CREATED_AT = 'fecha';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'humedad',
        'temp_ambiente',
        'temp_agua',
        'tds',
        'luz',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     * (Opcional, pero buena práctica)
     *
     * @var array
     */
    protected $casts = [
        'humedad' => 'float',
        'temp_ambiente' => 'float',
        'temp_agua' => 'float',
        'tds' => 'integer',
        'luz' => 'integer',
        'fecha' => 'datetime',
    ];
}