<?php

namespace App\Repositories\Supplier;

use App\Models\Supplier;
use Carbon\Carbon;

class SupplierRepository
{
    public function all()
    {
        return Supplier::all();
    }

    public function find($id)
    {
        return Supplier::findOrFail($id);
    }

    public function create(array $data): Supplier
    {
        return Supplier::create($data);
    }

    public function update(Supplier $supplier, array $data): Supplier
    {
        $supplier->update($data);
        return $supplier;
    }

    public function delete(Supplier $supplier, $userId): bool
    {
        return $supplier->update([
            'active' => 0,
            'user_updated' => $userId,
            'updated_at' => Carbon::now(),
        ]);
    }

    public function getActiveForCombo()
    {
        return Supplier::where('active', 1)->get();
    }
}
