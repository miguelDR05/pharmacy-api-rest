<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company() . ' S.A.',
            'ruc' => $this->faker->unique()->numerify('###########'), // RUC de 11 dígitos
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'active' => $this->faker->boolean(90),
            'user_created' => \App\Models\User::factory(),
            'user_updated' => null,
        ];
    }
}
