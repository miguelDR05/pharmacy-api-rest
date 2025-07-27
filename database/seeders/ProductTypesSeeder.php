<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductType;

class ProductTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductType::create(['name' => 'Antibiótico']);
        ProductType::create(['name' => 'Analgésico']);
        ProductType::create(['name' => 'Multivitamínico']);
    }
}
