<?php

namespace App\Repositories\ProductType;

use App\Models\ProductType;
use Carbon\Carbon;

class ProductTypeRepository
{
    public function all()
    {
        return ProductType::all();
    }

    public function find($id)
    {
        return ProductType::findOrFail($id);
    }

    public function create(array $data): ProductType
    {
        return ProductType::create($data);
    }

    public function update(ProductType $productType, array $data): ProductType
    {
        $productType->update($data);
        return $productType;
    }

    public function delete(ProductType $productType): bool
    {
        // Para ProductType, solo actualizamos 'active' ya que no tiene user_updated
        return $productType->update([
            'active' => 0,
            'updated_at' => Carbon::now(),
        ]);
    }

    public function getActiveForCombo()
    {
        return ProductType::where('active', 1)->get();
    }
}
