<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // Tablas base (sin dependencias)
            AreaSeeder::class,
            EstadosSeeder::class,
            FrecuenciasSeeder::class,
            TipoSolicitudesSeeder::class,
            TiposEquiposSeeder::class,
            
            // Tablas que dependen de áreas
            LocalizacionesSeeder::class,
            
            // Equipos (depende de tipos_equipos, area, localizaciones)
            EquiposMantSeeder::class,
            
            // Personas (depende de area y users)
            PersonasSeeder::class, 
            
            // Permisos y roles (Spatie)
            PermisosSeeder::class,
            RolesSeeder::class,
            UsersRolesSeeder::class,
        ]);
    }
}