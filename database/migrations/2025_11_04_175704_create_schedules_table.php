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
         Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('actuator_name'); // 'feeder', 'lights'
            $table->time('time'); // '14:30:00'
            $table->integer('portions')->default(1);
            $table->json('days'); // ['lunes', 'martes', ...]
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('actuator_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
