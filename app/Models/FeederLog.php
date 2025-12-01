<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeederLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_type',
        'details',
        'schedule_id', // ¡Cambiado de 'related_schedule_id' a 'schedule_id' para coincidir con la migración!
    ];

    protected $casts = [
        'details' => 'array',
    ];

    // Relación (opcional pero muy útil)
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
