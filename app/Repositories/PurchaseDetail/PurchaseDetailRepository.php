<?php

namespace App\Repositories\PurchaseDetail;

use App\Models\PurchaseDetail;
use Carbon\Carbon;

class PurchaseDetailRepository
{
    // Métodos CRUD básicos si fueran necesarios, pero generalmente se gestionan a través de Purchase
    public function create(array $data): PurchaseDetail
    {
        return PurchaseDetail::create($data);
    }

    public function update(PurchaseDetail $purchaseDetail, array $data): PurchaseDetail
    {
        $purchaseDetail->update($data);
        return $purchaseDetail;
    }

    public function delete(PurchaseDetail $purchaseDetail, $userId): bool
    {
        return $purchaseDetail->update([
            'active' => 0,
            'user_updated' => $userId,
            'updated_at' => Carbon::now(),
        ]);
    }
}
