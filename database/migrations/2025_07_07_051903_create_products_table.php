<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code')->unique(); // SKU o código interno
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('concentration')->nullable(); // Ej: 500mg, 10%
            $table->string('pharmaceutical_form'); // Ej: Tableta, Jarabe
            $table->string('administration_route')->nullable(); // Oral, Tópico
            $table->integer('stock')->default(0);
            $table->decimal('price', 10, 2);
            $table->date('expiration_date')->nullable();
            $table->string('batch')->nullable();

            $table->unsignedInteger('category_id');
            $table->unsignedInteger('lab_id');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('presentation_id');

            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('user_created')->nullable();
            $table->unsignedBigInteger('user_updated')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('lab_id')->references('id')->on('labs');
            $table->foreign('type_id')->references('id')->on('product_types');
            $table->foreign('presentation_id')->references('id')->on('product_presentations');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
