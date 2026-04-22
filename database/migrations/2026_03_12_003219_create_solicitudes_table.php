<?php
// database/migrations/2026_03_11_000001_create_solicitudes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->integer('id', 20)->primary();
            $table->string('titulo', 50);
            $table->string('id_equipo', 7)->nullable();
            $table->integer('id_falla')->nullable();
            $table->integer('id_solicitante');
            $table->integer('id_encargado')->nullable();
            $table->integer('id_tipo_solicitud');
            $table->string('id_area_proyecto', 3)->nullable();
            $table->integer('id_localizacion_edilicio')->nullable();
            $table->float('horas_de_trabajo')->nullable();
            $table->integer('id_estado');
            $table->datetime('fecha_alta')->useCurrent();
            $table->datetime('fecha_finalizacion')->nullable();
            $table->timestamp('deleted_at')->nullable();
            
            // Índices
            $table->index('id_tipo_solicitud');
            $table->index('id_estado');
            $table->index('id_area_proyecto');
            $table->index('id_encargado');
            $table->index('id_solicitante');
            $table->index('id_falla');
            $table->index('id_equipo');
            $table->index('id_localizacion_edilicio');
            
            // Foreign keys
            $table->foreign('id_tipo_solicitud')
                  ->references('id')
                  ->on('tipo_solicitudes')
                  ->onDelete('restrict');
                  
            $table->foreign('id_estado')
                  ->references('id')
                  ->on('estados')
                  ->onDelete('restrict');
                  
            $table->foreign('id_area_proyecto')
                  ->references('id_a')
                  ->on('area')
                  ->onDelete('restrict');
                  
            $table->foreign('id_encargado')
                  ->references('id_p')
                  ->on('personas')
                  ->onDelete('restrict');
                  
            $table->foreign('id_solicitante')
                  ->references('id_p')
                  ->on('personas')
                  ->onDelete('restrict');
                  
            $table->foreign('id_falla')
                  ->references('id')
                  ->on('tipos_equipos')
                  ->onDelete('restrict');
                  
            $table->foreign('id_equipo')
                  ->references('id')
                  ->on('equipos_mant')
                  ->onDelete('restrict');
                  
            $table->foreign('id_localizacion_edilicio')
                  ->references('id')
                  ->on('localizaciones')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};