<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable=[
        'descricao'
    ];


    public function produtos() {

        // return $this->hasMany(Categoria::class,'categorias_id','id');
        return $this->hasMany("App\Produto");
    }
}
