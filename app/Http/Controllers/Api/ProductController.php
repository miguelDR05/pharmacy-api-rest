<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\Product\ProductService;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Product\ProductResource; // Importa tu Resource
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
                data: ProductResource::collection($products)
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar', null, ['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_created'] = Auth::id(); // Agrega el usuario autenticado
            $product = $this->service->create($data);
            return responseApi(
                code: 200,
                title: 'Producto creada',
                message: 'Éxito',
                data: $product
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

    public function show(Product $product)
    {
        return responseApi(true, 'Producto', 'Consulta exitosa', $product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $data = $request->validated();
            $data['user_updated'] = Auth::id();
            $updated = $this->service->update($product, $data);
            return responseApi(
                code: 200,
                title: 'Categoría actualizada',
                message: 'Categoría actualizada correctamente',
                data: $updated
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

    public function destroy(Product $product)
    {
        try {
            $this->service->delete($product, Auth::id());
            return responseApi(true, 'Producto eliminado', 'Éxito');
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
