<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermisosSeeder extends Seeder
{
public function run(): void
    {
        $permisos = [
            'ver_solicitante',
            'ver_encargado',
            'actualizar-solicitud',
            'asignar-solicitud',
            'agregar-equiposmant',
            'editar-equiposmant',
            'eliminar-solicitud',
            'ver-todas-las-solicitudes',
            'ver-solicitudes-asignadas',
            'reporte-solicitudes',
            'ver-solicitudes-sin-asignar',
            'ver-todas-las-solicitudes-y-proyectos',
            'ver-proyectos',
            'correo-de-repuestos'
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso, 'guard_name' => 'web']);
        }
    }
}
