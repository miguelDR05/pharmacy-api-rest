<?php

namespace App\Repositories\Purchase;

use App\Models\Purchase;
use App\Models\PurchaseDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PurchaseRepository
{
    public function all()
    {
        return Purchase::with(['supplier', 'purchaseDocumentType', 'user', 'purchaseDetails.product'])->get();
    }

    public function find($id)
    {
        return Purchase::with(['supplier', 'purchaseDocumentType', 'user', 'purchaseDetails.product'])->findOrFail($id);
    }

    public function create(array $data): Purchase
    {
        $details = $data['details'];
        unset($data['details']); // Eliminar detalles antes de crear la compra principal

        $purchase = Purchase::create($data);

        foreach ($details as $detail) {
            $purchase->purchaseDetails()->create($detail);
        }

        return $purchase;
    }

    public function update(Purchase $purchase, array $data): Purchase
    {
        $details = $data['details'];
        unset($data['details']);

        $purchase->update($data);

        // Sincronizar detalles: eliminar los que no están, actualizar los existentes, crear nuevos
        $existingDetailIds = $purchase->purchaseDetails->pluck('id')->toArray();
        $incomingDetailIds = collect($details)->pluck('id')->filter()->toArray();

        // Eliminar detalles que ya no están en la solicitud
        $detailsToDelete = array_diff($existingDetailIds, $incomingDetailIds);
        if (!empty($detailsToDelete)) {
            PurchaseDetail::whereIn('id', $detailsToDelete)->update([
                'active' => 0,
                'user_updated' => $data['user_updated'],
                'updated_at' => Carbon::now(),
            ]);
        }

        foreach ($details as $detail) {
            if (isset($detail['id'])) {
                // Actualizar detalle existente
                $purchase->purchaseDetails()->where('id', $detail['id'])->update($detail);
            } else {
                // Crear nuevo detalle
                $purchase->purchaseDetails()->create($detail);
            }
        }

        return $purchase->load(['purchaseDetails.product']); // Recargar para obtener los detalles actualizados
    }

    public function delete(Purchase $purchase, $userId): bool
    {
        return $purchase->update([
            'active' => 0,
            'user_updated' => $userId,
            'updated_at' => Carbon::now(),
        ]);
    }
}
