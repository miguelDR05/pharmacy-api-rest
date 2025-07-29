<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\Category\CategoryService;
use App\Models\Category;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\CategoryComboResource;
use Illuminate\Support\Facades\Auth;
use Throwable;

class CategoryController extends Controller
{
    protected CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $categories = $this->service->list();
            return responseApi(
                code: 200,
                title: 'Listado de categorías',
                message: 'Consulta exitosa',
                data: CategoryResource::collection($categories)
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
                data: new CategoryResource($category) // Usar el Resource para la respuesta
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
        return responseApi(true, 'Categoría', 'Consulta exitosa', new CategoryResource($category));
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
                data: new CategoryResource($updated) // Usar el Resource para la respuesta
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

    public function destroy(Category $category)
    {
        try {
            $this->service->delete($category, Auth::id());
            return responseApi(true, 'Categoría eliminada', 'Éxito');
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
     * Obtiene categorías activas para un combo (select).
     */
    public function combo()
    {
        try {
            $categories = $this->service->getActiveCategoriesForCombo();
            return responseApi(
                code: 200,
                title: 'Listado de categorías para combo',
                message: 'Consulta exitosa',
                data: CategoryComboResource::collection($categories)
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar para combo', null, ['error' => $e->getMessage()], 500);
        }
    }
}
