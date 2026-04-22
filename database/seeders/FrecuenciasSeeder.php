<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class FrecuenciasSeeder extends Seeder
{
public function run(): void
    {
        $frecuencias = [
            ['id' => 1, 'nombre' => 'Una semana', 'dias' => 7],
            ['id' => 2, 'nombre' => 'Dos semanas', 'dias' => 14],
            ['id' => 3, 'nombre' => 'Un mes', 'dias' => 30],
            ['id' => 4, 'nombre' => 'Dos meses', 'dias' => 60],
            ['id' => 5, 'nombre' => 'Tres meses', 'dias' => 90],
            ['id' => 6, 'nombre' => 'Seis meses', 'dias' => 180],
            ['id' => 7, 'nombre' => 'Un año', 'dias' => 365],
            ['id' => 8, 'nombre' => 'Un año y medio', 'dias' => 545],
            ['id' => 9, 'nombre' => 'Dos años', 'dias' => 730],
            ['id' => 10, 'nombre' => 'Tres años', 'dias' => 1095],
        ];

        DB::table('frecuencias')->insert($frecuencias);
    }
}
