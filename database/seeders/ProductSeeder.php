<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Lab;
use App\Models\ProductType;
use App\Models\ProductPresentation;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Asegúrate de que existan las dependencias antes de crear productos
        $categories = Category::all();
        $labs = Lab::all();
        $productTypes = ProductType::all();
        $productPresentations = ProductPresentation::all();

        if ($categories->isEmpty()) {
            $this->call(CategorySeeder::class);
            $categories = Category::all();
        }
        if ($labs->isEmpty()) {
            $this->call(LabSeeder::class);
            $labs = Lab::all();
        }
        if ($productTypes->isEmpty()) {
            $this->call(ProductTypeSeeder::class);
            $productTypes = ProductType::all();
        }
        if ($productPresentations->isEmpty()) {
            $this->call(ProductPresentationSeeder::class);
            $productPresentations = ProductPresentation::all();
        }

        // Crear productos, asociando con IDs existentes
        Product::factory()->count(50)->create([
            'category_id' => $categories->random()->id,
            'lab_id' => $labs->random()->id,
            'type_id' => $productTypes->random()->id,
            'presentation_id' => $productPresentations->random()->id,
            'user_created' => \App\Models\User::first()->id, // Asigna al primer usuario creado
        ]);
    }
}
