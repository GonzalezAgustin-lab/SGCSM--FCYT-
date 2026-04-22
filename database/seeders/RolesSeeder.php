<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        // Crear roles
        $rolAdmin = Role::firstOrCreate(['name' => 'Administrador', 'guard_name' => 'web']);
        $rolJefe = Role::firstOrCreate(['name' => 'Jefe-Mantenimiento', 'guard_name' => 'web']);
        $rolEmpleado = Role::firstOrCreate(['name' => 'Empleado-Mantenimiento', 'guard_name' => 'web']);
        $rolEmpleadoComun = Role::firstOrCreate(['name' => 'Empelado', 'guard_name' => 'web']);

        // Asignar permisos a roles
        // Administrador tiene todos los permisos
        $rolAdmin->syncPermissions(Permission::all());

        // Jefe-Mantenimiento (permisos según role_has_permissions)
        $rolJefe->syncPermissions([
            'actualizar-solicitud',
            'asignar-solicitud',
            'agregar-equiposmant',
            'editar-equiposmant',
            'eliminar-solicitud',
            'ver-todas-las-solicitudes',
            'reporte-solicitudes'
        ]);

        // Empleado-Mantenimiento
        $rolEmpleado->syncPermissions([
            'actualizar-solicitud',
            'ver-solicitudes-asignadas',
            'reporte-solicitudes'
        ]);

        // Empleado común no tiene permisos especiales
    }
}