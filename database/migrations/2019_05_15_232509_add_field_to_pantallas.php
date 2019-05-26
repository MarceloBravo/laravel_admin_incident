<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToPantallas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pantallas', function (Blueprint $table) {
            $table->boolean("boton_crear");
            $table->boolean("boton_grabar");
            $table->boolean("boton_actualizar");
            $table->boolean("boton_eliminar");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pantallas', function (Blueprint $table) {
            //
        });
    }
}
