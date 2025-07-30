<?php

namespace Database\Factories;

use App\Models\ProductPresentation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductPresentationFactory extends Factory
{
    protected $model = ProductPresentation::class;

    public function definition()
    {
        return [
            // Aumenta la variedad de nombres posibles
            'name' => $this->faker->unique()->randomElement([
                'Caja x 10',
                'Frasco x 120ml',
                'Blister x 5',
                'Ampolla x 2ml',
                'Tubo x 30g',
                'Envase x 60ml', // Nuevo
                'Pote x 100g',    // Nuevo
                'Tabletas x 30',  // Nuevo
                'Gotas x 15ml',   // Nuevo
                'Spray x 50ml',   // Nuevo
                'Kit de 3',       // Nuevo
                'Solución x 200ml', // Nuevo
                'Caja x 20',      // Nuevo
                'Frasco x 250ml', // Nuevo
                'Blister x 10',   // Nuevo
                'Inyectable x 1ml', // Nuevo
                'Crema x 10g',    // Nuevo
                $this->faker->word() . ' x ' . $this->faker->numberBetween(1, 200) . $this->faker->randomElement(['ml', 'g', ' unidades']), // Genera más variedad
            ]),
            'active' => $this->faker->boolean(90),
        ];
    }
}
