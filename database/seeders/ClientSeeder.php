<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\DocumentType;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Asegúrate de que existan tipos de documento para asociar
        $dniType = DocumentType::where('name', 'DNI')->first();
        $rucType = DocumentType::where('name', 'RUC')->first();

        // Crear clientes con DNI
        Client::factory()->count(20)->create([
            'document_type_id' => $dniType ? $dniType->id : DocumentType::factory()->create(['name' => 'DNI', 'code' => '01'])->id,
        ]);

        // Crear clientes con RUC usando el estado 'ruc' del factory
        Client::factory()->count(5)->ruc()->create([
            'document_type_id' => $rucType ? $rucType->id : DocumentType::factory()->create(['name' => 'RUC', 'code' => '06'])->id,
        ]);
    }
}
