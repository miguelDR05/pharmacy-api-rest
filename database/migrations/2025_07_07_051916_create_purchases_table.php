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
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('purchase_date');
            $table->decimal('total', 10, 2);
            // supplier_id
            $table->unsignedInteger('supplier_id')->nullable();
            // purchase_document_type_id
            $table->unsignedInteger('purchase_document_type_id')->nullable();
            $table->string('document_number', 50)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('user_created')->nullable();
            $table->unsignedBigInteger('user_updated')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
