<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('document_types', function (Blueprint $table) {
            $table->id(); // equivale a int unsigned auto_increment primary key
            $table->string('name', 50)->unique();
            $table->string('code', 10)->nullable()->unique();
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('user_created')->nullable();
            $table->unsignedBigInteger('user_updated')->nullable();
            $table->timestamps(); // crea created_at y updated_at (ambos nullable por defecto)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_types');
    }
};
