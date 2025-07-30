<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Services\Client\ClientService;
use App\Models\Client;
use App\Http\Resources\Client\ClientResource;
use App\Http\Resources\Client\ClientComboResource;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ClientController extends Controller
{
    protected ClientService $service;

    public function __construct(ClientService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $clients = $this->service->list();
            return responseApi(
                code: 200,
                title: 'Listado de clientes',
                message: 'Consulta exitosa',
                data: ClientResource::collection($clients)
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar', null, ['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreClientRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_created'] = Auth::id();
            $client = $this->service->create($data);
            return responseApi(
                code: 200,
                title: 'Cliente creado',
                message: 'Éxito',
                data: new ClientResource($client)
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

    public function show(Client $client)
    {
        return responseApi(true, 'Cliente', 'Consulta exitosa', new ClientResource($client));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        try {
            $data = $request->validated();
            $data['user_updated'] = Auth::id();
            $updated = $this->service->update($client, $data);
            return responseApi(
                code: 200,
                title: 'Cliente actualizado',
                message: 'Cliente actualizado correctamente',
                data: new ClientResource($updated)
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

    public function destroy(Client $client)
    {
        try {
            $this->service->delete($client, Auth::id());
            return responseApi(true, 'Cliente eliminado', 'Éxito');
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
     * Obtiene clientes activos para un combo (select).
     */
    public function combo()
    {
        try {
            $clients = $this->service->getActiveClientsForCombo();
            return responseApi(
                code: 200,
                title: 'Listado de clientes para combo',
                message: 'Consulta exitosa',
                data: ClientComboResource::collection($clients)
            );
        } catch (Throwable $e) {
            return responseApi(false, 'Error', 'No se pudo listar para combo', null, ['error' => $e->getMessage()], 500);
        }
    }
}
