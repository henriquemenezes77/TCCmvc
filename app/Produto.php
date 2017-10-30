<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable=[
      'descricao','valor','id_categorias'
    ];

    public function categoria() {
    //1 para n
            return $this->belongsTo('App\Categoria', 'id_categorias', 'id');
    }

    public function imagens() {
        return $this->hasMany(ProdutosImg::class, 'id_produto');
    }
}
