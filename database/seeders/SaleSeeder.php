<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Client;
use App\Models\DocumentType;
use App\Models\User;
use Faker\Generator as Faker; // Importar la clase Faker

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Instanciar Faker para usarlo dentro del seeder
        $faker = app(Faker::class);

        $products = Product::all();
        $clients = Client::all();
        $documentTypes = DocumentType::all();
        $users = User::all();

        // Asegúrate de que existan las dependencias si las colecciones están vacías
        // (Esto es una buena práctica para seeders que dependen de otros)
        if ($products->isEmpty()) {
            $this->call(ProductSeeder::class);
            $products = Product::all();
        }
        if ($clients->isEmpty()) {
            $this->call(ClientSeeder::class);
            $clients = Client::all();
        }
        if ($documentTypes->isEmpty()) {
            $this->call(DocumentTypeSeeder::class);
            $documentTypes = DocumentType::all();
        }
        if ($users->isEmpty()) {
            $this->call(UserSeeder::class);
            $users = User::all();
        }

        Sale::factory()->count(30)->make()->each(function ($sale) use ($products, $clients, $documentTypes, $users, $faker) { // Pasar $faker al closure
            // Asigna IDs reales de las relaciones
            $sale->user_id = $users->random()->id;
            $sale->user_created = $users->random()->id;

            // Lógica para asignar client_id o document_type_id/document_number/customer_name
            if ($faker->boolean(70) && $clients->isNotEmpty()) { // Usar $faker aquí
                $sale->client_id = $clients->random()->id;
                $sale->document_type_id = null;
                $sale->document_number = null;
                $sale->customer_name = null;
            } else {
                $sale->client_id = null;
                $sale->document_type_id = $documentTypes->random()->id;
                $sale->document_number = $faker->numerify('########'); // Usar $faker aquí
                $sale->customer_name = $faker->name(); // Usar $faker aquí
            }

            $sale->save(); // Guarda la venta principal

            // Crear entre 1 y 5 detalles de venta para cada venta
            $numberOfDetails = $faker->numberBetween(1, 5); // Usar $faker aquí
            for ($i = 0; $i < $numberOfDetails; $i++) {
                $product = $products->random();
                $quantity = $faker->numberBetween(1, 5); // Usar $faker aquí
                $price = $product->price; // Usa el precio del producto
                $subtotal = $quantity * $price;

                $sale->saleDetails()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $subtotal,
                ]);
            }

            // Recalcular el total de la venta basado en los detalles creados
            $sale->total = $sale->saleDetails->sum('subtotal');
            $sale->save();
        });
    }
}
