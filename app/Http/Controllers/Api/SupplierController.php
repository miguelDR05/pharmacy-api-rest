<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use App\Services\Supplier\SupplierService;
use App\Models\Supplier;
use App\Http\Resources\Supplier\SupplierResource;
use App\Http\Resources\Supplier\SupplierComboResource;
use Illuminate\Support\Facades\Auth;
use Throwable;

class SupplierController extends Controller
{
    protected SupplierService $service;

    public function __construct(SupplierService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $suppliers = $this->service->list();
            return responseApi(
                code: 200,
                title: 'Listado de proveedores',
                message: 'Consulta exitosa',
                data: SupplierResource::collection($suppliers)
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar', null, ['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreSupplierRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_created'] = Auth::id();
            $supplier = $this->service->create($data);
            return responseApi(
                code: 200,
                title: 'Proveedor creado',
                message: 'Éxito',
                data: new SupplierResource($supplier)
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

    public function show(Supplier $supplier)
    {
        return responseApi(true, 'Proveedor', 'Consulta exitosa', new SupplierResource($supplier));
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        try {
            $data = $request->validated();
            $data['user_updated'] = Auth::id();
            $updated = $this->service->update($supplier, $data);
            return responseApi(
                code: 200,
                title: 'Proveedor actualizado',
                message: 'Proveedor actualizado correctamente',
                data: new SupplierResource($updated)
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

    public function destroy(Supplier $supplier)
    {
        try {
            $this->service->delete($supplier, Auth::id());
            return responseApi(true, 'Proveedor eliminado', 'Éxito');
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
     * Obtiene proveedores activos para un combo (select).
     */
    public function combo()
    {
        try {
            $suppliers = $this->service->getActiveSuppliersForCombo();
            return responseApi(
                code: 200,
                title: 'Listado de proveedores para combo',
                message: 'Consulta exitosa',
                data: SupplierComboResource::collection($suppliers)
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar para combo', null, ['error' => $e->getMessage()], 500);
        }
    }
}
