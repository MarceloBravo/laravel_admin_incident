<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePermisos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::create('permisos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rol_id')->unsigned();
            $table->boolean('ver');
            $table->boolean('crear');
            $table->boolean('modificar');
            $table->boolean('eliminar');
            $table->foreign('rol_id')->references('id')->on('roles');
            $table->timestamps();
            //$table->softDeletes();
        });
         * 
         */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_permisos');
    }
}
