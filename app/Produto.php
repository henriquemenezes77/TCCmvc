<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable=[
      'descricao','valor','id_categorias','imagem'
    ];

    public function categoria() {
        return $this->belongsTo(Categoria::class,'categorias_id','id');
    }
}
