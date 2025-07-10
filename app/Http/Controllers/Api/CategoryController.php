<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;

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

    public function store(CategoryRequest $request)
    {
        try {
            $userId = Auth::id();
            $category = $this->service->create($request->validated());
            $category['user_created'] = $userId;
            return responseApi(
                code: 200,
                title: 'Categoría creada',
                message: 'Éxito',
                data: $category
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo crear', null, ['error' => $e->getMessage()], 500);
        }
    }

    public function show(Category $category)
    {
        return responseApi(true, 'Detalle', 'Detalle de la categoría', $category);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $userId = Auth::id();
        $updated = $this->service->update($category, $request->validated());
        $data['user_updated'] = $userId;
        return responseApi(true, 'Actualizado', 'Categoría actualizada correctamente', $updated);
    }

    public function destroy(Category $category)
    {
        $this->service->delete($category);
        return responseApi(true, 200, 'Eliminado', 'Categoría eliminada correctamente');
    }
}
