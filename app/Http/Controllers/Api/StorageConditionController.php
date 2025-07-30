<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorageCondition\StoreStorageConditionRequest; // Nuevo Request
use App\Http\Requests\StorageCondition\UpdateStorageConditionRequest; // Nuevo Request
use App\Services\StorageCondition\StorageConditionService;
use App\Models\StorageCondition;
use App\Http\Resources\StorageCondition\StorageConditionResource; // Nuevo Resource
use App\Http\Resources\StorageCondition\StorageConditionComboResource;
use Illuminate\Support\Facades\Auth;
use Throwable;

class StorageConditionController extends Controller
{
    protected StorageConditionService $service;

    public function __construct(StorageConditionService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $conditions = $this->service->list();
            return responseApi(
                code: 200,
                title: 'Listado de condiciones de almacenamiento',
                message: 'Consulta exitosa',
                data: StorageConditionResource::collection($conditions)
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar', null, ['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreStorageConditionRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_created'] = Auth::id();
            $storageCondition = $this->service->create($data);
            return responseApi(
                code: 200,
                title: 'Condición de almacenamiento creada',
                message: 'Éxito',
                data: new StorageConditionResource($storageCondition)
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

    public function show(StorageCondition $storageCondition)
    {
        return responseApi(true, 'Condición de almacenamiento', 'Consulta exitosa', new StorageConditionResource($storageCondition));
    }

    public function update(UpdateStorageConditionRequest $request, StorageCondition $storageCondition)
    {
        try {
            $data = $request->validated();
            $data['user_updated'] = Auth::id();
            $updated = $this->service->update($storageCondition, $data);
            return responseApi(
                code: 200,
                title: 'Condición de almacenamiento actualizada',
                message: 'Condición de almacenamiento actualizada correctamente',
                data: new StorageConditionResource($updated)
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

    public function destroy(StorageCondition $storageCondition)
    {
        try {
            $this->service->delete($storageCondition, Auth::id());
            return responseApi(true, 'Condición de almacenamiento eliminada', 'Éxito');
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
     * Obtiene condiciones de almacenamiento activas para un combo (select).
     */
    public function combo()
    {
        try {
            $conditions = $this->service->getActiveStorageConditionsForCombo();
            return responseApi(
                code: 200,
                title: 'Listado de condiciones de almacenamiento para combo',
                message: 'Consulta exitosa',
                data: StorageConditionComboResource::collection($conditions)
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar para combo', null, ['error' => $e->getMessage()], 500);
        }
    }
}
