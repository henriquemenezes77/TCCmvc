<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProdutoImg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_img',function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_produtos')->unsigned();
            $table->string('imagem')->nullable();
            $table->timestamps();
            $table->foreign('id_produtos')->references('id')->on('produtos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produto_img');
    }
}
