<?php

namespace Database\Factories;

use App\Models\SaleDetail;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleDetailFactory extends Factory
{
    protected $model = SaleDetail::class;

    public function definition()
    {
        $quantity = $this->faker->numberBetween(1, 10);
        $price = $this->faker->randomFloat(2, 1, 50);
        $subtotal = $quantity * $price;

        return [
            'sale_id' => Sale::factory(), // Se sobrescribirá en el seeder
            'product_id' => Product::factory(), // Se sobrescribirá en el seeder
            'quantity' => $quantity,
            'price' => $price,
            'subtotal' => $subtotal,
        ];
    }
}
