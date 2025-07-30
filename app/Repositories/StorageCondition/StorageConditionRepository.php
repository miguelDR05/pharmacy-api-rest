<?php

namespace App\Repositories\StorageCondition;

use App\Models\StorageCondition;
use Carbon\Carbon;

class StorageConditionRepository
{
    public function all()
    {
        return StorageCondition::all();
    }

    public function find($id)
    {
        return StorageCondition::findOrFail($id);
    }

    public function create(array $data): StorageCondition
    {
        return StorageCondition::create($data);
    }

    public function update(StorageCondition $storageCondition, array $data): StorageCondition
    {
        $storageCondition->update($data);
        return $storageCondition;
    }

    public function delete(StorageCondition $storageCondition, $userId): bool
    {
        // Asumiendo un "soft delete" actualizando 'active' a 0 y registrando user_updated
        return $storageCondition->update([
            'active' => 0,
            'user_updated' => $userId,
            'updated_at' => Carbon::now(),
        ]);
    }

    public function getActiveForCombo()
    {
        return StorageCondition::where('active', 1)->get();
    }
}
