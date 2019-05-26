<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermisosRolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos_rol', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rol_id')->unsigned();
            $table->integer('permiso_id')->unsigned();
            $table->foreign('rol_id')->references('id')->on('roles');
            $table->foreign('permiso_id')->references('id')->on('permisos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permisos_rol');
    }
}
