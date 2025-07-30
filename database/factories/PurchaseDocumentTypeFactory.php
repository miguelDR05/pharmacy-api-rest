<?php

namespace Database\Factories;

use App\Models\PurchaseDocumentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseDocumentTypeFactory extends Factory
{
    protected $model = PurchaseDocumentType::class;

    public function definition()
    {
        // Define un conjunto de nombres que NO colisionen con los que insertas con firstOrCreate
        $availableNames = [
            'Guía de Remisión',
            'Recibo',
            'Orden de Compra',
            'Proforma',
            'Ticket',
            'Comprobante de Ingreso',
            'Remito',
            'Factura Proforma',
            'Nota de Débito',
            $this->faker->unique()->word() . ' ' . $this->faker->randomElement(['Documento', 'Comprobante']) . ' ' . $this->faker->numerify('##'),
            $this->faker->unique()->sentence(2, true),
        ];

        // Códigos que ya están reservados en el seeder
        $reservedCodes = ['01', '03', '07'];

        // Generar un código único que no esté en los reservados
        $generatedCode = $this->faker->unique()->numerify('##'); // Genera un código de 2 dígitos

        // Asegurarse de que el código generado no sea uno de los reservados
        // Esto es un bucle defensivo, pero Faker's unique() ya debería manejarlo si el pool es grande
        // Sin embargo, si el pool de números de 2 dígitos es pequeño y ya hay muchos en la DB,
        // este bucle podría ser necesario o el problema es que necesitas más dígitos.
        while (in_array($generatedCode, $reservedCodes)) {
            $generatedCode = $this->faker->unique()->numerify('##');
        }

        return [
            'name' => $this->faker->unique()->randomElement($availableNames),
            'code' => $generatedCode, // Usar el código generado y validado
            'active' => $this->faker->boolean(90),
            'user_created' => \App\Models\User::factory(),
            'user_updated' => null,
        ];
    }
}
