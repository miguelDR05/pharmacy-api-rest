<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word() . ' ' . $this->faker->unique()->word(), // Nombres de categoría únicos
            'active' => $this->faker->boolean(90),
            'user_created' => \App\Models\User::factory(),
            'user_updated' => null,
        ];
    }
}
