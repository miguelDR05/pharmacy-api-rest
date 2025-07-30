<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role_id' => 1,
            'name' => 'Admin',
            'email' => 'admin@farmacia.com',
            'password' => Hash::make('admin123')
        ]);

        User::create([
            'role_id' => 2,
            'name' => 'Cajero',
            'email' => 'cajero@farmacia.com',
            'password' => Hash::make('cajero123')
        ]);
    }
}
