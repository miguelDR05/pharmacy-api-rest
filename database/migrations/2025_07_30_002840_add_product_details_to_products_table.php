<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Añadir nuevas columnas (si no existen)
            // Asegúrate de que estas columnas se añadan solo si no existen ya de migraciones anteriores.
            // Para una migración nueva, esto es correcto.
            if (!Schema::hasColumn('products', 'min_stock')) {
                $table->integer('min_stock')->default(0)->after('stock');
            }
            if (!Schema::hasColumn('products', 'manufacturing_date')) {
                $table->date('manufacturing_date')->nullable()->after('batch');
            }
            if (!Schema::hasColumn('products', 'requires_prescription')) {
                $table->boolean('requires_prescription')->default(false)->after('concentration'); // Ajustado el 'after'
            }
            if (!Schema::hasColumn('products', 'is_controlled')) {
                $table->boolean('is_controlled')->default(false)->after('requires_prescription');
            }

            // Eliminar la columna 'storage_conditions' (string) si existe
            if (Schema::hasColumn('products', 'storage_conditions')) {
                $table->dropColumn('storage_conditions');
            }

            // Añadir la nueva clave foránea 'storage_condition_id'
            $table->unsignedSmallInteger('storage_condition_id')->nullable()->after('is_controlled'); // Usamos unsignedSmallInteger para IDs pequeños

            // Añadir la restricción de clave foránea
            $table->foreign('storage_condition_id')
                ->references('id')
                ->on('storage_conditions')
                ->onDelete('set null'); // Si una condición de almacenamiento es eliminada, se pone a null
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Eliminar la restricción de clave foránea primero
            $table->dropForeign(['storage_condition_id']);
            // Eliminar la columna de clave foránea
            $table->dropColumn('storage_condition_id');

            // Volver a añadir la columna original (string) si es necesario para rollback
            $table->string('storage_conditions')->nullable()->after('concentration'); // Revertir a la posición original

            // Eliminar las otras columnas añadidas en esta migración (si existen)
            if (Schema::hasColumn('products', 'min_stock')) {
                $table->dropColumn('min_stock');
            }
            if (Schema::hasColumn('products', 'manufacturing_date')) {
                $table->dropColumn('manufacturing_date');
            }
            if (Schema::hasColumn('products', 'requires_prescription')) {
                $table->dropColumn('requires_prescription');
            }
            if (Schema::hasColumn('products', 'is_controlled')) {
                $table->dropColumn('is_controlled');
            }
        });
    }
};
