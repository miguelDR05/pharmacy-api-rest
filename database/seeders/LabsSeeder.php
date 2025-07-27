<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lab;

class LabsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = 1;
        Lab::create(['name' => 'LabGen', 'user_created' => $userId]);
        Lab::create(['name' => 'Bayer', 'user_created' => $userId]);
        Lab::create(['name' => 'Pfizer', 'user_created' => $userId]);
    }
}
