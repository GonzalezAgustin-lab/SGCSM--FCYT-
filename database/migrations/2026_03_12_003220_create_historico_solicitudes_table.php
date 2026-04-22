<?php
// database/migrations/2026_03_11_000002_create_historico_solicitudes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historico_solicitudes', function (Blueprint $table) {
            $table->integer('id_solicitud');
            $table->integer('id_estado');
            $table->datetime('fecha')->useCurrent();
            $table->boolean('actual');
            $table->integer('id_persona');
            $table->string('descripcion', 500)->nullable();
            $table->boolean('repuestos')->nullable();
            $table->string('descripcion_repuestos', 500)->nullable();
            $table->timestamp('deleted_at')->nullable();
            
            // Primary key compuesta
            $table->primary(['id_solicitud', 'id_estado', 'fecha']);
            
            // Índices
            $table->index('id_estado');
            $table->index('id_persona');
            
            // Foreign keys
            $table->foreign('id_solicitud')
                  ->references('id')
                  ->on('solicitudes')
                  ->onDelete('cascade');
                  
            $table->foreign('id_estado')
                  ->references('id')
                  ->on('estados')
                  ->onDelete('restrict');
                  
            $table->foreign('id_persona')
                  ->references('id_p')
                  ->on('personas')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historico_solicitudes');
    }
};