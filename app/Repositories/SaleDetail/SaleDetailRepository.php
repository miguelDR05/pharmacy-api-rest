<?php

namespace App\Repositories\SaleDetail;

use App\Models\SaleDetail;

class SaleDetailRepository
{
    // Métodos CRUD básicos si fueran necesarios, pero generalmente se gestionan a través de Sale
    public function create(array $data): SaleDetail
    {
        return SaleDetail::create($data);
    }

    public function update(SaleDetail $saleDetail, array $data): SaleDetail
    {
        $saleDetail->update($data);
        return $saleDetail;
    }

    public function delete(SaleDetail $saleDetail): bool
    {
        return $saleDetail->delete();
    }
}
