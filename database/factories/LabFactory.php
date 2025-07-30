<?php

namespace Database\Factories;

use App\Models\Lab;
use Illuminate\Database\Eloquent\Factories\Factory;

class LabFactory extends Factory
{
    protected $model = Lab::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company() . ' Lab', // Nombres de laboratorio únicos
            'active' => $this->faker->boolean(90),
            'user_created' => \App\Models\User::factory(),
            'user_updated' => null,
        ];
    }
}
