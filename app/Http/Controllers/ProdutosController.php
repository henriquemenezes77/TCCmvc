<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProdutosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produto = Produto::get();
        return view('produtos.lista', ['produtos' => $produto]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function novo()
    {
        return view('produtos.formulario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'descricao' => 'required|max:100',
            'valor' => 'required|numeric',
            'id_categorias' => 'required',
        ]);
        $produto = Produto::create([
            'descricao' => $request['descricao'],
            'valor' => $request['valor'],
            'id_categorias' => $request['id_categorias'],
            'imagem' => $request['imagem'],
        ]);
        \Session::flash('mensagem_sucesso_produtos', 'Produto cadastrado com sucesso!!');
        return Redirect::to('produtos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        return view('produtos.fomulario', ['produto' => $produto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        $produto->update($request->all());
        $produto->update([
            'descricao' => $request['descricao'],
            'valor' => $request['valor'],
            'id_categorias' => $request['id_categorias'],
            'imagem' => $request['imagem'],
        ]);
        \Session::flash('mensagem_sucesso_produtos', 'Produto atualizado com sucesso!!');
        return Redirect::to('produtos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        \Session::flash('mensagem_sucesso_produtos', 'Produto deletado!');
        return back();
    }
}
