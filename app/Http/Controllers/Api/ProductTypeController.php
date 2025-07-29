<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductType\StoreProductTypeRequest;
use App\Http\Requests\ProductType\UpdateProductTypeRequest;
use App\Services\ProductType\ProductTypeService;
use App\Models\ProductType;
use App\Http\Resources\ProductType\ProductTypeResource;
use App\Http\Resources\ProductType\ProductTypeComboResource;
use Throwable;

class ProductTypeController extends Controller
{
    protected ProductTypeService $service;

    public function __construct(ProductTypeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $productTypes = $this->service->list();
            return responseApi(
                code: 200,
                title: 'Listado de tipos de producto',
                message: 'Consulta exitosa',
                data: ProductTypeResource::collection($productTypes)
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar', null, ['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreProductTypeRequest $request)
    {
        try {
            $data = $request->validated();
            // No user_created para ProductType según tu esquema
            $productType = $this->service->create($data);
            return responseApi(
                code: 200,
                title: 'Tipo de producto creado',
                message: 'Éxito',
                data: new ProductTypeResource($productType)
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

    public function show(ProductType $productType)
    {
        return responseApi(true, 'Tipo de producto', 'Consulta exitosa', new ProductTypeResource($productType));
    }

    public function update(UpdateProductTypeRequest $request, ProductType $productType)
    {
        try {
            $data = $request->validated();
            // No user_updated para ProductType según tu esquema
            $updated = $this->service->update($productType, $data);
            return responseApi(
                code: 200,
                title: 'Tipo de producto actualizado',
                message: 'Tipo de producto actualizado correctamente',
                data: new ProductTypeResource($updated)
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

    public function destroy(ProductType $productType)
    {
        try {
            $this->service->delete($productType); // No se pasa userId aquí
            return responseApi(true, 'Tipo de producto eliminado', 'Éxito');
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
     * Obtiene tipos de producto activos para un combo (select).
     */
    public function combo()
    {
        try {
            $productTypes = $this->service->getActiveProductTypesForCombo();
            return responseApi(
                code: 200,
                title: 'Listado de tipos de producto para combo',
                message: 'Consulta exitosa',
                data: ProductTypeComboResource::collection($productTypes)
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar para combo', null, ['error' => $e->getMessage()], 500);
        }
    }
}
