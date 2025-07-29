<?php

namespace App\Services\ProductType;

use App\Repositories\ProductType\ProductTypeRepository;
use App\Models\ProductType;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProductTypeService
{
    protected ProductTypeRepository $repo;

    public function __construct(ProductTypeRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list()
    {
        return $this->repo->all();
    }

    public function create(array $data): ProductType
    {
        DB::beginTransaction();
        try {
            $productType = $this->repo->create($data);
            DB::commit();
            return $productType;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(ProductType $productType, array $data): ProductType
    {
        DB::beginTransaction();
        try {
            $updated = $this->repo->update($productType, $data);
            DB::commit();
            return $updated;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(ProductType $productType): void
    {
        DB::beginTransaction();
        try {
            $this->repo->delete($productType); // No se pasa userId aquí
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getActiveProductTypesForCombo()
    {
        return $this->repo->getActiveForCombo();
    }
}
