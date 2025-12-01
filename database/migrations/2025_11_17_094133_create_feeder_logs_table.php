<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('feeder_logs', function (Blueprint $table) {
            $table->id();
            $table->string('event_type'); // 'manual_feed', 'schedule_created', 'schedule_toggled', 'schedule_deleted'
            $table->json('details')->nullable(); // Guardará detalles como {portions: 1} o {time: '12:00', new_status: true}

            // Clave foránea opcional para enlazar con el horario, si aplica
            $table->foreignId('schedule_id')
                  ->nullable()
                  ->constrained('schedules')
                  ->onDelete('set null'); // Si se borra el horario, el log no se borra, solo pierde la referencia

            $table->timestamps(); // 'created_at' será la hora del evento
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feeder_logs');
    }
};
