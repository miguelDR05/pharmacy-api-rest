<?php

namespace Database\Factories;

use App\Models\PurchaseDetail;
use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseDetailFactory extends Factory
{
    protected $model = PurchaseDetail::class;

    public function definition()
    {
        $quantity = $this->faker->numberBetween(5, 50);
        $price = $this->faker->randomFloat(2, 0.5, 30);
        $subtotal = $quantity * $price;

        return [
            'purchase_id' => Purchase::factory(), // Se sobrescribirá en el seeder
            'product_id' => Product::factory(), // Se sobrescribirá en el seeder
            'quantity' => $quantity,
            'price' => $price,
            'subtotal' => $subtotal,
        ];
    }
}
