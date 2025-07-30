<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseDocumentType;
use App\Models\User;

class PurchaseDocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PurchaseDocumentType::firstOrCreate(['name' => 'Factura', 'code' => '01'], ['active' => true, 'user_created' => User::first()->id]);
        PurchaseDocumentType::firstOrCreate(['name' => 'Boleta', 'code' => '03'], ['active' => true, 'user_created' => User::first()->id]);
        PurchaseDocumentType::firstOrCreate(['name' => 'Nota de Crédito', 'code' => '07'], ['active' => true, 'user_created' => User::first()->id]);
        PurchaseDocumentType::factory()->count(3)->create();
    }
}
