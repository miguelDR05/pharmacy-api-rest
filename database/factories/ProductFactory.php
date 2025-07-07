<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word . ' ' . $this->faker->randomElement(['500mg', '250mg', '100ml']),
            'code' => strtoupper($this->faker->unique()->bothify('PROD###')),
            'description' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(),
            'stock' => $this->faker->numberBetween(10, 100),
            'price' => $this->faker->randomFloat(2, 5, 100),
            'expiration_date' => $this->faker->dateTimeBetween('+3 months', '+2 years'),
            'batch' => strtoupper($this->faker->bothify('Lote###')),
            'concentration' => $this->faker->randomElement(['500mg', '10%', '100ml']),
            'pharmaceutical_form' => $this->faker->randomElement(['tableta', 'jarabe', 'ampolla']),
            'administration_route' => $this->faker->randomElement(['oral', 'inyectable']),
            'category_id' => 1,
            'lab_id' => 1,
            'type_id' => 1,
            'presentation_id' => 1,
            'active' => true,
            'user_created' => 1
        ];
    }
}
