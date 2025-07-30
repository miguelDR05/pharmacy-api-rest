<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentType;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Asegúrate de que los tipos de documento básicos existan
        DocumentType::firstOrCreate(['name' => 'DNI', 'code' => '01'], ['active' => true, 'user_created' => \App\Models\User::first()->id]);
        DocumentType::firstOrCreate(['name' => 'RUC', 'code' => '06'], ['active' => true, 'user_created' => \App\Models\User::first()->id]);
        DocumentType::firstOrCreate(['name' => 'Pasaporte', 'code' => '04'], ['active' => true, 'user_created' => \App\Models\User::first()->id]);
        DocumentType::firstOrCreate(['name' => 'Cédula de Identidad', 'code' => '03'], ['active' => true, 'user_created' => \App\Models\User::first()->id]);

        // Crear algunos tipos de documento adicionales usando el factory
        // DocumentType::factory()->count(3)->create();
    }
}
