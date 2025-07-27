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
        Category::create(['name' => 'Antibióticos', 'user_created' => $userId],);
        Category::create(['name' => 'Analgésicos', 'user_created' => $userId],);
        Category::create(['name' => 'Vitaminas', 'user_created' => $userId],);
    }
}
