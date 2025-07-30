<?php

namespace Database\Factories;

use App\Models\StorageCondition;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StorageConditionFactory extends Factory
{
    protected $model = StorageCondition::class;

    public function definition()
    {
        // Define un conjunto de condiciones de almacenamiento para evitar colisiones
        $conditions = [
            ['label' => 'Temperatura Ambiente (15-25°C)', 'value' => 'room_temperature'],
            ['label' => 'Refrigeración (2-8°C)', 'value' => 'refrigerated'],
            ['label' => 'Congelación (-18°C)', 'value' => 'frozen'],
            ['label' => 'Lugar Seco', 'value' => 'dry_place'],
            ['label' => 'Proteger de la Luz', 'value' => 'protect_from_light'],
            ['label' => 'Mantener en Oscuridad', 'value' => 'keep_in_dark'],
            ['label' => 'Almacenar en Vertical', 'value' => 'store_upright'],
            ['label' => 'Evitar Humedad', 'value' => 'avoid_humidity'],
        ];

        // Seleccionar una condición única del array
        static $usedConditions = [];
        $availableConditions = array_filter($conditions, function ($condition) use (&$usedConditions) {
            return !in_array($condition['value'], $usedConditions);
        });

        if (empty($availableConditions)) {
            // Si todas las condiciones predefinidas se han usado, generar una aleatoria
            $label = $this->faker->unique()->sentence(3, true);
            $value = $this->faker->unique()->slug(2);
        } else {
            $selected = $this->faker->unique()->randomElement($availableConditions);
            $label = $selected['label'];
            $value = $selected['value'];
            $usedConditions[] = $value; // Marcar como usado
        }

        return [
            'label' => $label,
            'value' => $value,
            'active' => $this->faker->boolean(90),
            'user_created' => User::factory(),
            'user_updated' => null,
        ];
    }
}
