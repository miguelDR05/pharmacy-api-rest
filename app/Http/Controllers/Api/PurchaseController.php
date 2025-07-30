<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\StorePurchaseRequest;
use App\Http\Requests\Purchase\UpdatePurchaseRequest;
use App\Services\Purchase\PurchaseService;
use App\Models\Purchase;
use App\Http\Resources\Purchase\PurchaseResource;
use Illuminate\Support\Facades\Auth;
use Throwable;

class PurchaseController extends Controller
{
    protected PurchaseService $service;

    public function __construct(PurchaseService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $purchases = $this->service->list();
            return responseApi(
                code: 200,
                title: 'Listado de compras',
                message: 'Consulta exitosa',
                data: PurchaseResource::collection($purchases)
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar', null, ['error' => $e->getMessage()], 500);
        }
    }

    public function store(StorePurchaseRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_created'] = Auth::id();
            $purchase = $this->service->create($data);
            return responseApi(
                code: 200,
                title: 'Compra creada',
                message: 'Éxito',
                data: new PurchaseResource($purchase)
            );
        } catch (Throwable $e) {
            return responseApi(
                success: false,
                title: 'Error',
                message: 'No se pudo crear',
                data: ['error' => $e->getMessage()],
                code: 500
            );
        }
    }

    public function show(Purchase $purchase)
    {
        return responseApi(true, 'Compra', 'Consulta exitosa', new PurchaseResource($purchase));
    }

    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        try {
            $data = $request->validated();
            $data['user_updated'] = Auth::id();
            $updated = $this->service->update($purchase, $data);
            return responseApi(
                code: 200,
                title: 'Compra actualizada',
                message: 'Compra actualizada correctamente',
                data: new PurchaseResource($updated)
            );
        } catch (Throwable $e) {
            return responseApi(
                success: false,
                title: 'Error',
                message: 'No se pudo actualizar',
                data: ['error' => $e->getMessage()],
                code: 500
            );
        }
    }

    public function destroy(Purchase $purchase)
    {
        try {
            $this->service->delete($purchase, Auth::id());
            return responseApi(true, 'Compra eliminada', 'Éxito');
        } catch (Throwable $e) {
            return responseApi(
                success: false,
                title: 'Error',
                message: 'No se pudo eliminar',
                data: ['error' => $e->getMessage()],
                code: 500
            );
        }
    }
}
