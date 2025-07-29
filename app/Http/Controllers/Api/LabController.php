<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lab\StoreLabRequest;
use App\Http\Requests\Lab\UpdateLabRequest;
use App\Services\Lab\LabService;
use App\Models\Lab;
use App\Http\Resources\Lab\LabResource;
use App\Http\Resources\Lab\LabComboResource;
use Illuminate\Support\Facades\Auth;
use Throwable;

class LabController extends Controller
{
    protected LabService $service;

    public function __construct(LabService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $labs = $this->service->list();
            return responseApi(
                code: 200,
                title: 'Listado de laboratorios',
                message: 'Consulta exitosa',
                data: LabResource::collection($labs)
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar', null, ['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreLabRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_created'] = Auth::id();
            $lab = $this->service->create($data);
            return responseApi(
                code: 200,
                title: 'Laboratorio creado',
                message: 'Éxito',
                data: new LabResource($lab)
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

    public function show(Lab $lab)
    {
        return responseApi(true, 'Laboratorio', 'Consulta exitosa', new LabResource($lab));
    }

    public function update(UpdateLabRequest $request, Lab $lab)
    {
        try {
            $data = $request->validated();
            $data['user_updated'] = Auth::id();
            $updated = $this->service->update($lab, $data);
            return responseApi(
                code: 200,
                title: 'Laboratorio actualizado',
                message: 'Laboratorio actualizado correctamente',
                data: new LabResource($updated)
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

    public function destroy(Lab $lab)
    {
        try {
            $this->service->delete($lab, Auth::id());
            return responseApi(true, 'Laboratorio eliminado', 'Éxito');
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
     * Obtiene laboratorios activos para un combo (select).
     */
    public function combo()
    {
        try {
            $labs = $this->service->getActiveLabsForCombo();
            return responseApi(
                code: 200,
                title: 'Listado de laboratorios para combo',
                message: 'Consulta exitosa',
                data: LabComboResource::collection($labs)
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar para combo', null, ['error' => $e->getMessage()], 500);
        }
    }
}
