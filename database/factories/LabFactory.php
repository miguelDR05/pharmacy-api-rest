<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Lab;

class LabFactory extends Factory
{
    protected $model = Lab::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'active' => true,
            'user_created' => 1
        ];
    }
}
