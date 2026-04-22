<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mantenimientos_programados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('equipo', 7); // Campo faltante
            $table->integer('frecuencia');
            $table->text('descripcion')->nullable();
            $table->boolean('activo')->default(true);
            $table->date('ultima_fecha_mantenimiento')->nullable();
            $table->date('fecha_de_inicio');
            $table->timestamps();

            $table->foreign('frecuencia')
                  ->references('id')
                  ->on('frecuencias')
                  ->onDelete('restrict');
                  
            $table->foreign('equipo')
                  ->references('id')
                  ->on('equipos_mant')
                  ->onDelete('restrict');
                  
            $table->index('equipo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mantenimientos_programados');
    }
};