<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DocumentType;

class DocumentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = 1;

        DocumentType::create([
            'name' => 'Documento nacional de identidad',
            'code' => 'DNI',
            'user_created' => $userId,
        ]);

        // Segundo cliente
        DocumentType::create([
            'name' => 'Registro único de contribuyentes',
            'code' => 'RUC',
            'user_created' => $userId,
        ]);
    }
}
