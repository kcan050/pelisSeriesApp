<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('extensionImg', 100)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('rol',['user','admin'])->default('user');
            $table->enum('espremium',['estandar','premium'])->default('estandar');
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
