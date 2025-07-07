<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Sale;

class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition(): array
    {
        return [
            'sale_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'total' => 0, // se calculará luego
            'client_id' => 1,
            'user_id' => 1,
            'active' => true,
            'user_created' => 1
        ];
    }
}
