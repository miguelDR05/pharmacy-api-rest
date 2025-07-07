<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductPresentation;

class ProductPresentationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductPresentation::insert([
            ['name' => 'Caja'],
            ['name' => 'Blister'],
            ['name' => 'Ampolla'],
        ]);
    }
}
