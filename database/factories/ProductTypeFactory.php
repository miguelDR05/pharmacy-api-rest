<?php

namespace Database\Factories;

use App\Models\ProductType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductTypeFactory extends Factory
{
    protected $model = ProductType::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Cápsulas',
                'Tabletas',
                'Jarabe',
                'Inyectable',
                'Crema',
                'Supositorio',
                'Solución Oral',
                'Spray Nasal',
                'Gotas Oftálmicas',
                'Gel Tópico',
                'Polvo para Suspensión',
                'Parches Transdérmicos',
                'Aerosol',
                'Óvulos',
                'Ungüento',
                'Emulsión',
                'Grageas',
                'Comprimidos',
                'Pastillas',
                'Elixir',
                'Suspensión',
                'Loción',
                'Ampolletas',
                'Viales',
                'Nebulizador',
                'Inhalador',
                'Colirio',
                // Generar nombres más complejos y únicos para evitar colisiones
                $this->faker->unique()->word() . ' ' . $this->faker->randomElement(['Forma', 'Tipo', 'Presentación']) . ' ' . $this->faker->numerify('###'),
                $this->faker->unique()->sentence(3, true), // Genera una frase corta única
                $this->faker->unique()->text(25), // Genera un texto corto único
            ]),
            'active' => $this->faker->boolean(90),
        ];
    }
}
