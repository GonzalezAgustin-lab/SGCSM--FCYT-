<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->integer('id_p', true);
            $table->string('nombre_p', 100);
            $table->string('apellido', 100)->nullable();
            $table->integer('dni')->nullable();
            $table->integer('interno')->nullable();
            $table->string('correo', 50)->nullable();
            $table->date('fe_nac')->nullable();
            $table->date('fe_ing')->nullable();
            $table->string('area', 3);
            $table->boolean('jefe');
            $table->unsignedBigInteger('usuario')->nullable();
            $table->boolean('activo')->nullable();
            $table->timestamps();
            
            $table->foreign('area')
                  ->references('id_a')
                  ->on('area')
                  ->onDelete('restrict');
                  
            $table->foreign('usuario')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};