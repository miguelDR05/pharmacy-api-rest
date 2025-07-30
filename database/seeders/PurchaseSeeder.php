<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\PurchaseDocumentType;
use App\Models\User;
use Faker\Generator as Faker; // Importar la clase Faker

class PurchaseSeeder extends Seeder
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
        $suppliers = Supplier::all();
        $purchaseDocumentTypes = PurchaseDocumentType::all();
        $users = User::all();

        // Asegúrate de que existan las dependencias si las colecciones están vacías
        if ($products->isEmpty()) {
            $this->call(ProductSeeder::class);
            $products = Product::all();
        }
        if ($suppliers->isEmpty()) {
            $this->call(SupplierSeeder::class);
            $suppliers = Supplier::all();
        }
        if ($purchaseDocumentTypes->isEmpty()) {
            $this->call(PurchaseDocumentTypeSeeder::class);
            $purchaseDocumentTypes = PurchaseDocumentType::all();
        }
        if ($users->isEmpty()) {
            $this->call(UserSeeder::class);
            $users = User::all();
        }

        Purchase::factory()->count(20)->make()->each(function ($purchase) use ($products, $suppliers, $purchaseDocumentTypes, $users, $faker) { // Pasar $faker al closure
            // Asigna IDs reales de las relaciones
            $purchase->supplier_id = $suppliers->random()->id;
            $purchase->purchase_document_type_id = $purchaseDocumentTypes->random()->id;
            $purchase->user_id = $users->random()->id;
            $purchase->user_created = $users->random()->id;
            $purchase->save(); // Guarda la compra principal

            // Crear entre 1 y 5 detalles de compra para cada compra
            $numberOfDetails = $faker->numberBetween(1, 5); // Usar $faker aquí
            for ($i = 0; $i < $numberOfDetails; $i++) {
                $product = $products->random();
                $quantity = $faker->numberBetween(5, 20); // Usar $faker aquí
                $price = $faker->randomFloat(2, 0.5, 30); // Usar $faker aquí
                $subtotal = $quantity * $price;

                $purchase->purchaseDetails()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $subtotal,
                ]);
            }

            // Recalcular el total de la compra basado en los detalles creados
            $purchase->total = $purchase->purchaseDetails->sum('subtotal');
            $purchase->save();
        });
    }
}
