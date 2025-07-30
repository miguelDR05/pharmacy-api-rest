<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\DocumentType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition()
    {
        // Obtener un ID de DocumentType existente de forma aleatoria.
        // Si no existe ninguno, crea uno nuevo (esto solo debería pasar si el seeder no se ejecutó).
        $documentTypeId = DocumentType::inRandomOrder()->first()->id ?? DocumentType::factory()->create()->id;

        return [
            'document_type_id' => $documentTypeId, // Usar un ID existente o uno recién creado
            'document_number' => $this->faker->unique()->numerify('########'), // DNI de 8 dígitos
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'active' => $this->faker->boolean(90),
            'user_created' => User::factory(),
            'user_updated' => null,
        ];
    }

    // Estado para clientes con RUC
    public function ruc()
    {
        return $this->state(function (array $attributes) {
            // Asegúrate de que el tipo RUC exista o créalo si no
            $rucDocumentType = DocumentType::where('name', 'RUC')->first() ?? DocumentType::factory()->create(['name' => 'RUC', 'code' => '06', 'user_created' => \App\Models\User::first()->id]);

            return [
                'document_type_id' => $rucDocumentType->id,
                'document_number' => $this->faker->unique()->numerify('###########'), // RUC de 11 dígitos
                'name' => $this->faker->unique()->company(),
            ];
        });
    }
}
