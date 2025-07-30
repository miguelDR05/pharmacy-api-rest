<?php

namespace App\Repositories\Client;

use App\Models\Client;
use Carbon\Carbon;

class ClientRepository
{
    public function all()
    {
        return Client::with('documentType')->get();
    }

    public function find($id)
    {
        return Client::with('documentType')->findOrFail($id);
    }

    public function create(array $data): Client
    {
        return Client::create($data);
    }

    public function update(Client $client, array $data): Client
    {
        $client->update($data);
        return $client;
    }

    public function delete(Client $client, $userId): bool
    {
        return $client->update([
            'active' => 0,
            'user_updated' => $userId,
            'updated_at' => Carbon::now(),
        ]);
    }

    public function getActiveForCombo()
    {
        return Client::where('active', 1)->get();
    }
}
