<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersRolesSeeder extends Seeder
{
    public function run(): void
    {
        // Crear UN SOLO usuario administrador genérico
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123'), // Cambiar en producción
                'email_verified_at' => now(),
            ]
        );

        // Asignar rol de Administrador
        $role = Role::where('name', 'Administrador')->first();
        if ($role) {
            $adminUser->assignRole($role);
            $this->command->info('✅ Usuario administrador creado:');
            $this->command->info('   Email: admin@admin.com');
            $this->command->info('   Password: admin123');
            $this->command->info('   ⚠️  CAMBIAR CONTRASEÑA EN PRODUCCIÓN');
        }
    }
}