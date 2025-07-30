<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Administrador', 'description' => 'Acceso completo']);
        Role::create(['name' => 'Cajero', 'description' => 'Solo ventas']);
        Role::create(['name' => 'Almacén', 'description' => 'Gestión de inventario']);
    }
}
