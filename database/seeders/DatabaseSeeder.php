<?php

namespace Database\Seeders;

use App\Models\User;
use Dom\Document;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            // Seeders de tablas sin dependencias complejas o que son maestras
            DocumentTypeSeeder::class,
            CategorySeeder::class,
            LabSeeder::class,
            StorageConditionSeeder::class,
            ProductTypeSeeder::class,
            ProductPresentationSeeder::class,
            SupplierSeeder::class,
            PurchaseDocumentTypeSeeder::class,
            // Seeders que dependen de las tablas maestras
            ClientSeeder::class,
            ProductSeeder::class,
            // Seeders de transacciones (Ventas y Compras)
            // Estos crearán sus respectivos detalles anidados
            SaleSeeder::class,
            PurchaseSeeder::class,
        ]);
    }
}
