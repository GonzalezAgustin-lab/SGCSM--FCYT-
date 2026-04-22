<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class EstadosSeeder extends Seeder
{
        public function run(): void
    {
        $estados = [
            ['id' => 1, 'nombre' => 'Abierta'],
            ['id' => 2, 'nombre' => 'Asignada'],
            ['id' => 3, 'nombre' => 'En proceso'],
            ['id' => 4, 'nombre' => 'Rep. pendientes'],
            ['id' => 5, 'nombre' => 'Aprob. pendiente'],
            ['id' => 6, 'nombre' => 'Aprobada'],
            ['id' => 7, 'nombre' => 'Reclamada'],
        ];

        DB::table('estados')->insert($estados);
    }
}
