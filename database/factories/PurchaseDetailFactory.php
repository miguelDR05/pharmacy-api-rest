<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PurchaseDetail;

class PurchaseDetailFactory extends Factory
{
    protected $model = PurchaseDetail::class;

    public function definition(): array
    {
        $quantity = $this->faker->numberBetween(10, 100);
        $price = $this->faker->randomFloat(2, 2, 20);
        return [
            'product_id' => 1,
            'quantity' => $quantity,
            'price' => $price,
            'subtotal' => $quantity * $price
        ];
    }
}
