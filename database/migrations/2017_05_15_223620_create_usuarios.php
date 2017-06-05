<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('usuarios',function(Blueprint $table){
          $table->increments('id');
          $table->string('name');
          $table->string('email')->unique();
          $table->string('senha', 10);
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
        //
    }
}
