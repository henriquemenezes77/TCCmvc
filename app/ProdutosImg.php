<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutosImg extends Model
{
    protected $fillable = ['id_produto','imagem'];

    public function produtos(){
        //1 para n
        return $this->belongsTo(Produto::class);
    }
}
