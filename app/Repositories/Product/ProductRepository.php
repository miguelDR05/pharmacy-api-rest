<?php

namespace App\Repositories\Product;

use App\Models\Product;

class ProductRepository
{
    public function all()
    {
        return Product::with(['category', 'lab', 'type', 'presentation'])->get();
    }

    public function find($id)
    {
        return Product::findOrFail($id);
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(Product $product, array $data): Product
    {
        $product->update($data);
        return $product;
    }

    public function delete(Product $product): bool
    {
        return $product->delete();
    }
}
