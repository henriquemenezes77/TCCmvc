<?php

namespace App\Http\Controllers;

use App\Produto;
use App\Categoria;
use App\ProdutosImg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;


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
        return view('produtos.lista')
            ->with('produtos', Produto::all())
            ->with('categorias', Categoria::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function novo()
    {
        //retorna view novo produto com as categorias
        return view('produtos.formulario')
            ->with('categorias', Categoria::all());
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
            'descricao' => 'required',
            'valor' => 'required',
            'id_categorias' => 'required'
        ]);

        //verifica se a img existe e faz a validação da mesma
        //if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
        //   $filePath = $request->file('imagem')->store('public');

        $produto = Produto::create([
            'descricao' => $request['descricao'],
            'valor' => $request['valor'],
            'id_categorias' => $request['id_categorias']
        ]);

        if ($request->hasFile('imagem')) {
            foreach ($request->file('imagem') as $imagem) {
                if ($imagem->isValid()) {
                    $produto->imagens()->create([
                        'imagem' => $imagem->store('public')
                    ]);
                }
            }

            \Session::flash('mensagem_sucesso_produtos', 'Produto cadastrado com sucesso!!');
            return Redirect::to('produtos');
        } else {
            Produto::create($request->all());
            \Session::flash('mensagem_sucesso_produtos', 'Produto cadastrado com sucesso!!');
            return Redirect::to('produtos');
        }
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

    Public function edit(Produto $produto)
    {
        //aqui esta editando produto
        return view('produtos.formulario')
            ->with('produto', $produto)
            ->with('categorias', Categoria::all());
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
        //atualização de produto
        $this->validate($request, [
            'descricao' => 'required',
            'valor' => 'required',
            'id_categorias' => 'required'
        ]);

        $produto->fill($request->except('imagem'))->update();

        if ($request->hasFile('imagem')) {
            foreach ($request->file('imagem') as $imagem) {
                if ($imagem->isValid()) {
                    $produto->imagens()->create([
                        'imagem' => $imagem->store('public')
                    ]);
                }
            }
        }


        \Session::flash('mensagem_sucesso_produtos', "Produto atualizado com sucesso");
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
        //deleta produto
        $produto->delete();
        \Session::flash('mensagem_sucesso_produtos', 'Produto deletado!');
        return back();
    }
    public function deleteImg(Produto $produto, ProdutosImg $imagem)
    {
        $imagem->delete();
        \Session::flash('mensagem_sucesso_produtos','Imagem deletada!');
        return back();
    }
}
