<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeliculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peliculas', function (Blueprint $table) {
          
            $table->id()->autoIncrement();
            $table->string('titulo', 100)->unique();
            $table->date('fecha')->useCurrent();
            $table->integer('duracion')->nullable();
            $table->string('studio', 100);
            $table->enum('puntaje', [0,0.5,1,1.5,2,2.5,3,3.5,4,4.5,5]);
            $table->string('extensionImg', 100)->nullable();
            $table->text('descripcion');
            $table->enum('espremium', ['estandar','premium']);
            $table->enum('categoria', ['Terror','Accion','Animacion','Ciencia Ficcion','Suspense','Drama'.'Comedia']);
            $table->enum('categoria2', ['Terror','Accion','Animacion','Ciencia Ficcion','Suspense','Drama','Comedia']);
            $table->enum('edad', ['APT','+9','+12','+16','+18']);
            $table->softDeletes();
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
        Schema::dropIfExists('peliculas');
    }
}
