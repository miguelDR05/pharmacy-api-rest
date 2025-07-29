<?php

namespace App\Services\ProductPresentation;

use App\Repositories\ProductPresentation\ProductPresentationRepository;
use App\Models\ProductPresentation;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProductPresentationService
{
    protected ProductPresentationRepository $repo;

    public function __construct(ProductPresentationRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list()
    {
        return $this->repo->all();
    }

    public function create(array $data): ProductPresentation
    {
        DB::beginTransaction();
        try {
            $productPresentation = $this->repo->create($data);
            DB::commit();
            return $productPresentation;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(ProductPresentation $productPresentation, array $data): ProductPresentation
    {
        DB::beginTransaction();
        try {
            $updated = $this->repo->update($productPresentation, $data);
            DB::commit();
            return $updated;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(ProductPresentation $productPresentation): void
    {
        DB::beginTransaction();
        try {
            $this->repo->delete($productPresentation); // No se pasa userId aquí
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getActiveProductPresentationsForCombo()
    {
        return $this->repo->getActiveForCombo();
    }
}
