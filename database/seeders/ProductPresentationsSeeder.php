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
        ProductPresentation::create(['name' => 'Caja']);
        ProductPresentation::create(['name' => 'Blister']);
        ProductPresentation::create(['name' => 'Ampolla']);
    }
}
