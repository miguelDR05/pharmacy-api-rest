<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = 1;
        Client::insert([
            ['dni' => '12345678', 'name' => 'Juan Pérez', 'user_created' => $userId],
            ['dni' => '87654321', 'name' => 'María López', 'user_created' => $userId],
        ]);
    }
}
