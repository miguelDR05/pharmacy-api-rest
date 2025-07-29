<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductPresentation\StoreProductPresentationRequest;
use App\Http\Requests\ProductPresentation\UpdateProductPresentationRequest;
use App\Services\ProductPresentation\ProductPresentationService;
use App\Models\ProductPresentation;
use App\Http\Resources\ProductPresentation\ProductPresentationResource;
use App\Http\Resources\ProductPresentation\ProductPresentationComboResource;
use Throwable;

class ProductPresentationController extends Controller
{
    protected ProductPresentationService $service;

    public function __construct(ProductPresentationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $productPresentations = $this->service->list();
            return responseApi(
                code: 200,
                title: 'Listado de presentaciones de producto',
                message: 'Consulta exitosa',
                data: ProductPresentationResource::collection($productPresentations)
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar', null, ['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreProductPresentationRequest $request)
    {
        try {
            $data = $request->validated();
            // No user_created para ProductPresentation según tu esquema
            $productPresentation = $this->service->create($data);
            return responseApi(
                code: 200,
                title: 'Presentación de producto creada',
                message: 'Éxito',
                data: new ProductPresentationResource($productPresentation)
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

    public function show(ProductPresentation $productPresentation)
    {
        return responseApi(true, 'Presentación de producto', 'Consulta exitosa', new ProductPresentationResource($productPresentation));
    }

    public function update(UpdateProductPresentationRequest $request, ProductPresentation $productPresentation)
    {
        try {
            $data = $request->validated();
            // No user_updated para ProductPresentation según tu esquema
            $updated = $this->service->update($productPresentation, $data);
            return responseApi(
                code: 200,
                title: 'Presentación de producto actualizada',
                message: 'Presentación de producto actualizada correctamente',
                data: new ProductPresentationResource($updated)
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

    public function destroy(ProductPresentation $productPresentation)
    {
        try {
            $this->service->delete($productPresentation); // No se pasa userId aquí
            return responseApi(true, 'Presentación de producto eliminada', 'Éxito');
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
     * Obtiene presentaciones de producto activas para un combo (select).
     */
    public function combo()
    {
        try {
            $productPresentations = $this->service->getActiveProductPresentationsForCombo();
            return responseApi(
                code: 200,
                title: 'Listado de presentaciones de producto para combo',
                message: 'Consulta exitosa',
                data: ProductPresentationComboResource::collection($productPresentations)
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar para combo', null, ['error' => $e->getMessage()], 500);
        }
    }
}
