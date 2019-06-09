<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableChat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_chat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('incident_id')->unsigned();
            $table->foreign('incident_id')->references('id')->on('incidencias');
            $table->integer('from_user_id')->unsigned();
            $table->foreign('from_user_id')->references('id')->on('users');
            $table->integer('to_user_id')->nullable();
            $table->string('mensaje');
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
        Schema::dropIfExists('table_chat');
    }
}
