<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            // $table->unsignedBigInteger('purchase_document_type_id')->nullable();
            $table->foreign('purchase_document_type_id')
                ->references('id')
                ->on('purchase_document_types');
        });
    }

    public function down(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropForeign(['purchase_document_type_id']);
            // $table->dropColumn('purchase_document_type_id');
        });
    }
};
