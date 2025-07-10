<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\Product\ProductService;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ProductController extends Controller
{
    protected ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $products = $this->service->list();
            return responseApi(
                code: 200,
                title: 'Listado de productos',
                message: 'Consulta exitosa',
                data: $products
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar', null, ['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $userId = Auth::id();
            $product = $this->service->create($request->validated());
            $product['user_created'] =  $userId;
            return responseApi(

                true,
                'Producto creado',
                'Éxito',
                $product
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo crear', null, ['error' => $e->getMessage()], 500);
        }
    }

    public function show(Product $product)
    {
        return responseApi(true, 'Producto', 'Consulta exitosa', $product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $updated = $this->service->update($product, $request->validated());
            return responseApi(true, 'Producto actualizado', 'Éxito', $updated);
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo actualizar', null, ['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Product $product)
    {
        try {
            $this->service->delete($product);
            return responseApi(true, 'Producto eliminado', 'Éxito');
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo eliminar', null, ['error' => $e->getMessage()], 500);
        }
    }
}
