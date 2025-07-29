<?php

namespace App\Repositories\ProductPresentation;

use App\Models\ProductPresentation;
use Carbon\Carbon; // Importar Carbon

class ProductPresentationRepository
{
    public function all()
    {
        return ProductPresentation::all();
    }

    public function find($id)
    {
        return ProductPresentation::findOrFail($id);
    }

    public function create(array $data): ProductPresentation
    {
        return ProductPresentation::create($data);
    }

    public function update(ProductPresentation $productPresentation, array $data): ProductPresentation
    {
        $productPresentation->update($data);
        return $productPresentation;
    }

    public function delete(ProductPresentation $productPresentation): bool
    {
        // Para ProductPresentation, solo actualizamos 'active' ya que no tiene user_updated
        return $productPresentation->update([
            'active' => 0,
            'updated_at' => Carbon::now(),
        ]);
    }

    public function getActiveForCombo()
    {
        return ProductPresentation::where('active', 1)->get();
    }
}
