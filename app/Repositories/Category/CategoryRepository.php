<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Carbon\Carbon; // Importar Carbon

class CategoryRepository
{
    public function all()
    {
        return Category::all();
    }

    public function find($id)
    {
        return Category::findOrFail($id);
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function update(Category $category, array $data): Category
    {
        $category->update($data);
        return $category;
    }

    public function delete(Category $category, $userId): bool
    {
        // Asumiendo un "soft delete" actualizando 'active' a 0 y registrando user_updated
        return $category->update([
            'active' => 0,
            'user_updated' => $userId,
            'updated_at' => Carbon::now(),
        ]);
    }

    public function getActiveForCombo()
    {
        return Category::where('active', 1)->get();
    }
}
