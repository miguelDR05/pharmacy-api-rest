<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Purchase;

class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;

    public function definition(): array
    {
        return [
            'purchase_date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'total' => 0,
            'user_id' => 1,
            'active' => true,
            'user_created' => 1
        ];
    }
}
