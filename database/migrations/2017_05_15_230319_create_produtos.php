<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos',function(Blueprint $table){
            $table->increments('id');
            $table->string('descricao');
            $table->decimal('valor',10,2);
            $table->integer('id_categorias')->unsigned();
            $table->string('imagem')->nullable();
            $table->timestamps();

            $table->foreign('id_categorias')->references('id')->on('categorias')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
        Schema::drop('categorias');
    }
}
