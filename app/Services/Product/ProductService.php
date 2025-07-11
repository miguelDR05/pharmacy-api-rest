<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductService
{
    protected ProductRepository $repo;

    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list()
    {
        return $this->repo->all();
    }

    public function create(array $data): Product
    {
        DB::beginTransaction();

        try {
            if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
                $data['image'] = saveImage($data['image']);
            }

            $product = $this->repo->create($data);
            DB::commit();
            return $product;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(Product $product, array $data): Product
    {
        DB::beginTransaction();

        try {
            if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
                if ($product->image) deleteImage($product->image);
                $data['image'] = saveImage($data['image']);
            }

            $updated = $this->repo->update($product, $data);
            DB::commit();
            return $updated;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(Product $product, $userId): void
    {
        DB::beginTransaction();

        try {
            if ($product->image) deleteImage($product->image);
            $this->repo->delete($product, $userId);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
