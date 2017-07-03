<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable=[
      'descricao','valor','id_categorias','imagem'
    ];

    // Não sei nem o que dizer sobre isto.. 
    // O método até retorna correto mas o nome é 
    // confuso.. vc pega a categoria do produto fazendo
    // $produto->produto() ??
    // acho que o melhor seria $produto->categoria() né ??
    // public function produto() {
    public function categoria() {
        // return $this->belongsTo(Categoria::class,'categorias_id','id');
        return $this->belongsTo('App\Categoria', 'id_categorias', 'id');
    }
}
