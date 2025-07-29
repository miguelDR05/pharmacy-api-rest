<?php

namespace App\Repositories\Lab;

use App\Models\Lab;
use Carbon\Carbon; // Importar Carbon

class LabRepository
{
    public function all()
    {
        return Lab::all();
    }

    public function find($id)
    {
        return Lab::findOrFail($id);
    }

    public function create(array $data): Lab
    {
        return Lab::create($data);
    }

    public function update(Lab $lab, array $data): Lab
    {
        $lab->update($data);
        return $lab;
    }

    public function delete(Lab $lab, $userId): bool
    {
        // Asumiendo un "soft delete" actualizando 'active' a 0 y registrando user_updated
        return $lab->update([
            'active' => 0,
            'user_updated' => $userId,
            'updated_at' => Carbon::now(),
        ]);
    }

    public function getActiveForCombo()
    {
        return Lab::where('active', 1)->get();
    }
}
