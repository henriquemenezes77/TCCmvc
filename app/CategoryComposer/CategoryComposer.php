<?php

/**
 * Created by PhpStorm.
 * User: Henrique
 * Date: 21/06/2017
 * Time: 19:29
 */
class CategoryComposer
{
    public function compose($view)
    {
        $categorias = \App\Categoria::all();

        $view->with(compact('categorias'));
    }
}