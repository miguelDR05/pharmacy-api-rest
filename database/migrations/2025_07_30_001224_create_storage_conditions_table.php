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
        Schema::create('storage_conditions', function (Blueprint $table) {
            $table->smallIncrements('id'); // ID auto-incrementable de tipo SMALLINT (unsigned)
            $table->string('label')->unique(); // Etiqueta legible (ej. "Temperatura Ambiente")
            $table->string('value')->unique(); // Valor interno/código (ej. "room_temperature")
            $table->boolean('active')->default(true);
            $table->bigInteger('user_created')->unsigned()->nullable();
            $table->bigInteger('user_updated')->unsigned()->nullable();
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('storage_conditions');
    }
};
