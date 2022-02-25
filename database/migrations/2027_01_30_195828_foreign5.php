<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Foreign5 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagenes', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pelicula')->nullable();
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->unsignedBigInteger('id_serie')->nullable();
            
           
            
            $table->foreign('id_pelicula')->references('id')->on('peliculas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_serie')->references('id')->on('series')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagenes', function (Blueprint $table) {
            //
        });
    }
}
