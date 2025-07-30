<?php

namespace App\Repositories\PurchaseDocumentType;

use App\Models\PurchaseDocumentType;
use Carbon\Carbon;

class PurchaseDocumentTypeRepository
{
    public function all()
    {
        return PurchaseDocumentType::all();
    }

    public function find($id)
    {
        return PurchaseDocumentType::findOrFail($id);
    }

    public function create(array $data): PurchaseDocumentType
    {
        return PurchaseDocumentType::create($data);
    }

    public function update(PurchaseDocumentType $purchaseDocumentType, array $data): PurchaseDocumentType
    {
        $purchaseDocumentType->update($data);
        return $purchaseDocumentType;
    }

    public function delete(PurchaseDocumentType $purchaseDocumentType, $userId): bool
    {
        return $purchaseDocumentType->update([
            'active' => 0,
            'user_updated' => $userId,
            'updated_at' => Carbon::now(),
        ]);
    }

    public function getActiveForCombo()
    {
        return PurchaseDocumentType::where('active', 1)->get();
    }
}
