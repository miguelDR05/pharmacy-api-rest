<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = 1;
        Category::insert([
            ['name' => 'Antibióticos', 'user_created' => $userId],
            ['name' => 'Analgésicos', 'user_created' => $userId],
            ['name' => 'Vitaminas', 'user_created' => $userId],
        ]);
    }
}
