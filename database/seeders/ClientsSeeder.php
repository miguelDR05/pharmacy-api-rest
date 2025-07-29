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

        // Primer cliente
        Client::create([
            'document_type_id' => 1,
            'document_number' => '71436151',
            'name' => 'Segundo Miguel',
            'user_created' => $userId,
        ]);

        // Segundo cliente
        Client::create([
            'document_type_id' => 2,
            'document_number' => '20103615080',
            'name' => 'María López',
            'user_created' => $userId,
        ]);
    }
}
