<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Necesario para CURRENT_TIMESTAMP

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prueba', function (Blueprint $table) {
            $table->id(); // Corresponde a id INT AUTO_INCREMENT PRIMARY KEY
            $table->float('humedad');
            $table->float('temp_ambiente');
            $table->float('temp_agua');
            $table->integer('tds');
            $table->tinyInteger('luz');
            // Corresponde a fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            $table->timestamp('fecha')->default(DB::raw('CURRENT_TIMESTAMP')); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prueba');
    }
};