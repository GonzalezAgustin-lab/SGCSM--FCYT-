<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TipoSolicitudesSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            ['id' => 1, 'nombre' => 'Especializado'],
            ['id' => 2, 'nombre' => 'Edilicio'],
        ];

        DB::table('tipo_solicitudes')->insert($tipos);
    }
}
