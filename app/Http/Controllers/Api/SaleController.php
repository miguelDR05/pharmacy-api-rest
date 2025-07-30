<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\StoreSaleRequest;
use App\Http\Requests\Sale\UpdateSaleRequest;
use App\Services\Sale\SaleService;
use App\Models\Sale;
use App\Http\Resources\Sale\SaleResource;
use Illuminate\Support\Facades\Auth;
use Throwable;

class SaleController extends Controller
{
    protected SaleService $service;

    public function __construct(SaleService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $sales = $this->service->list();
            return responseApi(
                code: 200,
                title: 'Listado de ventas',
                message: 'Consulta exitosa',
                data: SaleResource::collection($sales)
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar', null, ['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreSaleRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_created'] = Auth::id();
            $sale = $this->service->create($data);
            return responseApi(
                code: 200,
                title: 'Venta creada',
                message: 'Éxito',
                data: new SaleResource($sale)
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

    public function show(Sale $sale)
    {
        return responseApi(true, 'Venta', 'Consulta exitosa', new SaleResource($sale));
    }

    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        try {
            $data = $request->validated();
            $data['user_updated'] = Auth::id();
            $updated = $this->service->update($sale, $data);
            return responseApi(
                code: 200,
                title: 'Venta actualizada',
                message: 'Venta actualizada correctamente',
                data: new SaleResource($updated)
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

    public function destroy(Sale $sale)
    {
        try {
            $this->service->delete($sale, Auth::id());
            return responseApi(true, 'Venta eliminada', 'Éxito');
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
