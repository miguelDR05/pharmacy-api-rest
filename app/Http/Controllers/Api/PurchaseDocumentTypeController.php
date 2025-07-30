<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseDocumentType\StorePurchaseDocumentTypeRequest;
use App\Http\Requests\PurchaseDocumentType\UpdatePurchaseDocumentTypeRequest;
use App\Services\PurchaseDocumentType\PurchaseDocumentTypeService;
use App\Models\PurchaseDocumentType;
use App\Http\Resources\PurchaseDocumentType\PurchaseDocumentTypeResource;
use App\Http\Resources\PurchaseDocumentType\PurchaseDocumentTypeComboResource;
use Illuminate\Support\Facades\Auth;
use Throwable;

class PurchaseDocumentTypeController extends Controller
{
    protected PurchaseDocumentTypeService $service;

    public function __construct(PurchaseDocumentTypeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $purchaseDocumentTypes = $this->service->list();
            return responseApi(
                code: 200,
                title: 'Listado de tipos de documento de compra',
                message: 'Consulta exitosa',
                data: PurchaseDocumentTypeResource::collection($purchaseDocumentTypes)
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar', null, ['error' => $e->getMessage()], 500);
        }
    }

    public function store(StorePurchaseDocumentTypeRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_created'] = Auth::id();
            $purchaseDocumentType = $this->service->create($data);
            return responseApi(
                code: 200,
                title: 'Tipo de documento de compra creado',
                message: 'Éxito',
                data: new PurchaseDocumentTypeResource($purchaseDocumentType)
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

    public function show(PurchaseDocumentType $purchaseDocumentType)
    {
        return responseApi(true, 'Tipo de documento de compra', 'Consulta exitosa', new PurchaseDocumentTypeResource($purchaseDocumentType));
    }

    public function update(UpdatePurchaseDocumentTypeRequest $request, PurchaseDocumentType $purchaseDocumentType)
    {
        try {
            $data = $request->validated();
            $data['user_updated'] = Auth::id();
            $updated = $this->service->update($purchaseDocumentType, $data);
            return responseApi(
                code: 200,
                title: 'Tipo de documento de compra actualizado',
                message: 'Tipo de documento de compra actualizado correctamente',
                data: new PurchaseDocumentTypeResource($updated)
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

    public function destroy(PurchaseDocumentType $purchaseDocumentType)
    {
        try {
            $this->service->delete($purchaseDocumentType, Auth::id());
            return responseApi(true, 'Tipo de documento de compra eliminado', 'Éxito');
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

    /**
     * Obtiene tipos de documento de compra activos para un combo (select).
     */
    public function combo()
    {
        try {
            $purchaseDocumentTypes = $this->service->getActivePurchaseDocumentTypesForCombo();
            return responseApi(
                code: 200,
                title: 'Listado de tipos de documento de compra para combo',
                message: 'Consulta exitosa',
                data: PurchaseDocumentTypeComboResource::collection($purchaseDocumentTypes)
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar para combo', null, ['error' => $e->getMessage()], 500);
        }
    }
}
