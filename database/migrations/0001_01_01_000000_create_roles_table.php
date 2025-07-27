<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->boolean('active')->default(true);
            // Lógica condicional para SQL Server
            if (DB::connection()->getDriverName() === 'sqlsrv') {
                // Para SQL Server, usamos dateTimeTz o dateTime con una precisión explícita (ej. 7)
                // DATETIME2(7) es el más flexible y compatible
                $table->dateTimeTz('created_at', 7)->nullable();
                $table->dateTimeTz('updated_at', 7)->nullable();
            } else {
                // Para MySQL, PostgreSQL, SQLite, etc., usamos timestamps() normal
                $table->timestamps();
            }

            $table->foreign('role_id')->references('id')->on('roles');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
