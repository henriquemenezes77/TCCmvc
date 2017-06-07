<?php

namespace App\Http\Controllers;

use App\Produto;
use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

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
        return view('produtos.lista')->with('produtos', Produto::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function novo()
    {
        //se vc quiser ter a lista de categorias na sua view vc tem que enviar elas pra lá.. :)
        return view('produtos.formulario')->with('categorias', Categoria::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //verifica se a img existe e é válida.. e faz a
        if($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            //pega o nome da imagem para armazenar na base (nome+extensao)
            $filename = $request->imagem->getFilename() . '.' . $request->imagem->extension();
            //move a imagem para /public/images
            $request->imagem->move(public_path('images'), $filename);
            //salva o bixo..
            $produto = Produto::create([
                'descricao' => $request['descricao'],
                'valor' => $request['valor'],
                'id_categorias' => $request['id_categorias'],
                'imagem' => $filename,
            ]);
            
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
