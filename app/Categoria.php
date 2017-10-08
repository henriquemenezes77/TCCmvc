<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable=[
        'descricao','imagem'
    ];

    public function produtos() {
        return $this->hasMany("App\Produto");
    }
}
