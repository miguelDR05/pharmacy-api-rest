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
            DocumentTypesSeeder::class,
            RolesSeeder::class,
            UsersSeeder::class,
            CategoriesSeeder::class,
            LabsSeeder::class,
            ProductTypesSeeder::class,
            ProductPresentationsSeeder::class,
            ClientsSeeder::class,
        ]);
    }
}
