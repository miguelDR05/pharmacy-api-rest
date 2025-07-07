<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SaleDetail;

class SaleDetailFactory extends Factory
{
    protected $model = SaleDetail::class;

    public function definition(): array
    {
        $quantity = $this->faker->numberBetween(1, 5);
        $price = $this->faker->randomFloat(2, 10, 100);
        return [
            'product_id' => 1,
            'quantity' => $quantity,
            'price' => $price,
            'subtotal' => $quantity * $price
        ];
    }
}
