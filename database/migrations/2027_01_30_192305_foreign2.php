<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Foreign2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarioSeries', function (Blueprint $table) {
             
             $table->unsignedBigInteger('id_usuario')->nullable();
            $table->unsignedBigInteger('id_serie')->nullable(); 
         
               $table->foreign('id_usuario')->references('id')->on('users');
               $table->foreign('id_serie')->references('id')->on('series');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarioSeries', function (Blueprint $table) {
            //
        });
    }
}
