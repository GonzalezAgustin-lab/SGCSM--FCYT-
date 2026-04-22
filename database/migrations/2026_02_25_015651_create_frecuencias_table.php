<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('frecuencias', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre', 30);
            $table->integer('dias');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('frecuencias');
    }
};