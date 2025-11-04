<?php
// app/Models/Command.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    use HasFactory;
    
    // Importante: permite la asignación masiva
    protected $fillable = [
        'actuator_name',
        'command_value',
        'is_pending',
    ];
}