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
            $table->string('descricao',100);
            $table->decimal('valor',5,2); //n esquece de validar isto antes de armazenar senão da treta
            $table->integer('id_categorias')->unsigned();
            $table->foreign('id_categorias')->references('id')->on('categorias');
            $table->string('imagem');
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
        Schema::dropIfExists('produtos');
    }
}
