<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentType\StoreDocumentTypeRequest;
use App\Http\Requests\DocumentType\UpdateDocumentTypeRequest;
use App\Services\DocumentType\DocumentTypeService;
use App\Models\DocumentType;
use App\Http\Resources\DocumentType\DocumentTypeResource;
use App\Http\Resources\DocumentType\DocumentTypeComboResource;
use Illuminate\Support\Facades\Auth;
use Throwable;

class DocumentTypeController extends Controller
{
    protected DocumentTypeService $service;

    public function __construct(DocumentTypeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $documentTypes = $this->service->list();
            return responseApi(
                code: 200,
                title: 'Listado de tipos de documento',
                message: 'Consulta exitosa',
                data: DocumentTypeResource::collection($documentTypes)
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar', null, ['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreDocumentTypeRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_created'] = Auth::id();
            $documentType = $this->service->create($data);
            return responseApi(
                code: 200,
                title: 'Tipo de documento creado',
                message: 'Éxito',
                data: new DocumentTypeResource($documentType)
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

    public function show(DocumentType $documentType)
    {
        return responseApi(true, 'Tipo de documento', 'Consulta exitosa', new DocumentTypeResource($documentType));
    }

    public function update(UpdateDocumentTypeRequest $request, DocumentType $documentType)
    {
        try {
            $data = $request->validated();
            $data['user_updated'] = Auth::id();
            $updated = $this->service->update($documentType, $data);
            return responseApi(
                code: 200,
                title: 'Tipo de documento actualizado',
                message: 'Tipo de documento actualizado correctamente',
                data: new DocumentTypeResource($updated)
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

    public function destroy(DocumentType $documentType)
    {
        try {
            $this->service->delete($documentType, Auth::id());
            return responseApi(true, 'Tipo de documento eliminado', 'Éxito');
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
     * Obtiene tipos de documento activos para un combo (select).
     */
    public function combo()
    {
        try {
            $documentTypes = $this->service->getActiveDocumentTypesForCombo();
            return responseApi(
                code: 200,
                title: 'Listado de tipos de documento para combo',
                message: 'Consulta exitosa',
                data: DocumentTypeComboResource::collection($documentTypes)
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar para combo', null, ['error' => $e->getMessage()], 500);
        }
    }
}
