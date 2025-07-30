<?php

namespace Database\Factories;

use App\Models\Sale;
use App\Models\Client;
use App\Models\DocumentType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition()
    {
        // Decide si la venta tendrá un cliente registrado o será a un no-cliente
        $hasClient = $this->faker->boolean(70); // 70% de probabilidad de tener un cliente

        $clientId = null;
        $documentTypeId = null;
        $documentNumber = null;
        $customerName = null;

        if ($hasClient) {
            // Asigna un cliente existente de forma aleatoria. Si no hay, crea uno.
            $clientId = Client::inRandomOrder()->first()->id ?? Client::factory()->create()->id;
        } else {
            // Si no hay cliente, asigna un tipo de documento existente de forma aleatoria.
            // Si no hay, crea uno.
            $documentTypeId = DocumentType::inRandomOrder()->first()->id ?? DocumentType::factory()->create()->id;
            $documentNumber = $this->faker->numerify('########'); // Genera un número de documento
            $customerName = $this->faker->name(); // Genera un nombre de cliente
        }

        return [
            'sale_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'total' => $this->faker->randomFloat(2, 10, 1000),
            'client_id' => $clientId,
            'document_type_id' => $documentTypeId,
            'document_number' => $documentNumber,
            'customer_name' => $customerName,
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id, // Usuario que realizó la venta
            'active' => true,
            'user_created' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'user_updated' => null,
        ];
    }
}
