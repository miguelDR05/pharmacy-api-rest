<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductPresentation;

class ProductPresentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductPresentation::factory()->count(7)->create();
    }
}
