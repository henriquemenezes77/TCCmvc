<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('produtos', 'ProdutosController@index');
Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'HomeController@index');
    Route::auth();
    Route::get('/home', 'HomeController@index');
    //usuarios
    Route::get('usuarios', 'UsuariosController@index');
    Route::get('usuarios/novo', 'UsuariosController@novo')->name('usuarios.novo');
    Route::get('usuarios/deletar/{user}', 'UsuariosController@destroy')->name("usuarios.deletar");
    Route::post('usuarios/salvar', 'UsuariosController@salvar');
    Route::get('usuarios/{user}/editar', 'UsuariosController@editar')->name('usuarios.editar');
    Route::patch('usuarios/{user}', 'UsuariosController@atualizar');
    //categorias
    Route::get('categorias', 'CategoriasController@index');
    Route::get('categorias/novo', 'CategoriasController@novo')->name("categoria.novo");
    Route::get('categorias/deletar/{categoria}', 'CategoriasController@destroy');
    Route::post('categorias/salvar', 'CategoriasController@store');
    Route::get('categorias/{categoria}/editar', 'CategoriasController@edit');
    Route::patch('categorias/{categoria}', 'CategoriasController@update');
    //produtos
    Route::get('produtos', 'ProdutosController@index');
    Route::get('produtos/novo', 'ProdutosController@novo')->name('produtos.novo');
    Route::post('produtos/salvar', 'ProdutosController@store')->name('produtos.salvar');
    Route::get('produtos/deletar/{produto}', 'ProdutosController@destroy');
    Route::delete('produtos/deletar/{produto}/{imagem}','ProdutosController@deleteImg');
    Route::get('produtos/editar/{produto}', 'ProdutosController@edit')->name('produtos.editar');
    Route::patch('produtos/{produto}', 'ProdutosController@update')->name('produtos.update');
    View::composer('templates.main', 'CategoryComposer');
});
Auth::routes();

