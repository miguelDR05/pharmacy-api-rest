<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductPresentation;

class ProductPresentationFactory extends Factory
{
    protected $model = ProductPresentation::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Caja', 'Blister', 'Ampolla', 'Jarabe']),
            'active' => true
        ];
    }
}
