<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable=[
        'descricao'
    ];


    //Aqui também podemos verificar a nomenclatura...
    //hasMany = tem muitos.. logo são muitos produtos para uma
    //categoria.. talvez devessemos renomear para produtos()
    // public function produto() {
    public function produtos() {

        //Então vc quer dizer que uma categoria tem produtos.. 
        //e ela é vinculada com uma outra categoria?? pela fk categorias_id ?? T_T
        // return $this->hasMany(Categoria::class,'categorias_id','id');
        return $this->hasMany("App\Produto");
    }
}
