<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StorageCondition;
use App\Models\User; // Asegúrate de importar el modelo User

class StorageConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Asegúrate de que al menos un usuario exista para user_created
        $user = User::first() ?? User::factory()->create();

        // Datos específicos que quieres asegurar que existan
        $specificConditions = [
            ['label' => 'Temperatura Ambiente (15-25°C)', 'value' => 'room_temperature'],
            ['label' => 'Refrigeración (2-8°C)', 'value' => 'refrigerated'],
            ['label' => 'Congelación (-18°C)', 'value' => 'frozen'],
            ['label' => 'Lugar Seco', 'value' => 'dry_place'],
            ['label' => 'Proteger de la Luz', 'value' => 'protect_from_light'],
        ];

        foreach ($specificConditions as $condition) {
            StorageCondition::firstOrCreate(
                ['value' => $condition['value']], // Criterio de búsqueda
                array_merge($condition, ['active' => true, 'user_created' => $user->id]) // Atributos a crear
            );
        }

        // Crear condiciones adicionales usando el factory para variedad
        // StorageCondition::factory()->count(5)->create();
    }
}
