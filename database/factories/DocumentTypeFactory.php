<?php

namespace Database\Factories;

use App\Models\DocumentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentTypeFactory extends Factory
{
    protected $model = DocumentType::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement(['DNI', 'RUC', 'Pasaporte', 'Cédula de Identidad']),
            'code' => $this->faker->unique()->numerify('####'), // Códigos de ejemplo
            'active' => $this->faker->boolean(90), // 90% de probabilidad de estar activo
            'user_created' => \App\Models\User::factory(), // Asocia con un usuario existente o crea uno
            'user_updated' => null,
        ];
    }
}
