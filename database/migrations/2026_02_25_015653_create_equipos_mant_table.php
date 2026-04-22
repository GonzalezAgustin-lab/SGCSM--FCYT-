<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipos_mant', function (Blueprint $table) {
            $table->string('id', 7)->primary();
            $table->string('marca', 100)->nullable();
            $table->string('modelo', 100)->nullable();
            $table->string('num_serie', 50)->nullable();
            $table->string('descripcion', 1000)->nullable();
            $table->boolean('uso');
            $table->integer('id_tipo');
            $table->string('id_area', 3);
            $table->integer('id_localizacion')->nullable();
            
            $table->foreign('id_tipo')
                  ->references('id')
                  ->on('tipos_equipos')
                  ->onDelete('restrict');
                  
            $table->foreign('id_area')
                  ->references('id_a')
                  ->on('area')
                  ->onDelete('restrict');
                  
            $table->foreign('id_localizacion')
                  ->references('id')
                  ->on('localizaciones')
                  ->onDelete('restrict');
                  
            $table->index(['id_tipo', 'id_localizacion']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipos_mant');
    }
};