<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class UsersSeeder extends Seeder
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
            'password' => Hash::make('admin123'),
            'active' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ]);

        User::create([
            'role_id' => 2,
            'name' => 'Cajero',
            'email' => 'cajero@farmacia.com',
            'password' => Hash::make('cajero123'),
            'active' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ]);
    }
}
