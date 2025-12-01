<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    // 👇 ESTO ES LO QUE FALTABA 👇
    protected $fillable = [
        'key', 
        'value'
    ];
}