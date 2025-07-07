<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['name' => 'Administrador', 'description' => 'Acceso completo'],
            ['name' => 'Cajero', 'description' => 'Solo ventas'],
            ['name' => 'Almacén', 'description' => 'Gestión de inventario'],
        ]);
    }
}
