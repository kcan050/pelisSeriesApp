<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Foreign3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarioPeliculas', function (Blueprint $table) {
             $table->unsignedBigInteger('id_usuario')->nullable();
             $table->unsignedBigInteger('id_pelicula')->nullable();
             $table->foreign('id_usuario')->references('id')->on('users');
             $table->foreign('id_pelicula')->references('id')->on('peliculas');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarioPeliculas', function (Blueprint $table) {
            //
        });
    }
}
