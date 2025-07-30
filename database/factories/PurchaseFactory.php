<?php

namespace Database\Factories;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\PurchaseDocumentType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;

    public function definition()
    {
        return [
            'purchase_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'total' => $this->faker->randomFloat(2, 100, 5000),
            'supplier_id' => Supplier::factory(), // Asocia con un proveedor
            'purchase_document_type_id' => PurchaseDocumentType::factory(), // Asocia con un tipo de documento de compra
            'document_number' => $this->faker->bothify('SER-######'), // Número de documento de compra
            'user_id' => User::factory(), // Usuario que registró la compra
            'active' => true,
            'user_created' => User::factory(),
            'user_updated' => null,
        ];
    }
}
