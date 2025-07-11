<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\Category\CategoryService;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Throwable;

class CategoryController extends Controller
{
    protected $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $category =  $this->service->list();
            return responseApi(
                code: 200,
                title: 'Listado de categorías',
                message: 'Consulta exitosa',
                data: $category
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar', null, ['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_created'] = Auth::id();
            $category = $this->service->create($data);
            return responseApi(
                code: 200,
                title: 'Categoría creada',
                message: 'Éxito',
                data: $category
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

    public function show(Category $category)
    {
        return responseApi(true, 'Detalle', 'Detalle de la categoría', $category);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $data = $request->validated();
            $data['user_updated'] = Auth::id();
            $updated = $this->service->update($category, $data);
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

    public function destroy(Category $category)
    {
        try {
            $this->service->delete($category, Auth::id());
            return responseApi(
                code: 200,
                title: 'Categoría eliminada',
                message: 'Categoría eliminada correctamente',
            );
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
