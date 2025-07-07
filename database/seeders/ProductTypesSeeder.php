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
        ProductType::insert([
            ['name' => 'Antibiótico'],
            ['name' => 'Analgésico'],
            ['name' => 'Multivitamínico'],
        ]);
    }
}
