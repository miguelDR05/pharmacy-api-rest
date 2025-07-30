<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Lab;
use App\Models\ProductType;
use App\Models\ProductPresentation;
use App\Models\StorageCondition; // Importar el nuevo modelo
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        // Obtener IDs existentes o crear nuevos si no hay
        $productTypeId = ProductType::inRandomOrder()->first()->id ?? ProductType::factory()->create()->id;
        $categoryId = Category::inRandomOrder()->first()->id ?? Category::factory()->create()->id;
        $labId = Lab::inRandomOrder()->first()->id ?? Lab::factory()->create()->id;
        $presentationId = ProductPresentation::inRandomOrder()->first()->id ?? ProductPresentation::factory()->create()->id;
        $userId = User::inRandomOrder()->first()->id ?? User::factory()->create()->id;
        // --- NUEVO: Obtener StorageCondition ID ---
        $storageConditionId = StorageCondition::inRandomOrder()->first()->id ?? StorageCondition::factory()->create()->id;


        return [
            'name' => $this->faker->unique()->word() . ' ' . $this->faker->word() . ' ' . $this->faker->randomElement(['500mg', '120ml', '10mg']),
            'code' => $this->faker->unique()->numerify('PRD########'),
            'description' => $this->faker->sentence(),
            'image' => 'https://via.placeholder.com/150/' . $this->faker->hexColor() . '/ffffff?text=' . urlencode($this->faker->word()),
            'stock' => $this->faker->numberBetween(10, 500),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'expiration_date' => $this->faker->dateTimeBetween('+1 month', '+5 years'),
            'batch' => $this->faker->bothify('BATCH-####-??'),
            'concentration' => $this->faker->randomElement(['500mg', '10mg/ml', '250mcg']),
            'pharmaceutical_form' => $this->faker->randomElement(['Cápsula', 'Tableta', 'Jarabe', 'Crema', 'Inyectable']),
            'administration_route' => $this->faker->randomElement(['Oral', 'Tópica', 'Inyectable', 'Rectal']),
            'category_id' => $categoryId,
            'lab_id' => $labId,
            'type_id' => $productTypeId,
            'presentation_id' => $presentationId,
            'active' => $this->faker->boolean(95),
            'user_created' => $userId,
            'user_updated' => null,
            // --- NUEVAS COLUMNAS ---
            'min_stock' => $this->faker->numberBetween(1, 10),
            'manufacturing_date' => $this->faker->dateTimeBetween('-2 years', '-1 month'),
            'requires_prescription' => $this->faker->boolean(),
            'is_controlled' => $this->faker->boolean(),
            // --- CAMBIO AQUÍ: Usar storage_condition_id ---
            'storage_condition_id' => $storageConditionId,
        ];
    }
}
