<?php

namespace App\Http\Controllers;

use App\Produto;
use App\Categoria;
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
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {

            // $filename = $this->saveImage($request, null);

            $filePath = $request->file('imagem')->store('public');

            //pega o nome da imagem para armazenar na base (nome+extensao)
            // $filename = $request->imagem->getFilename() . '.' . $request->imagem->extension();
            //move a imagem para /public/images
            // $request->imagem->move(public_path('images'), $filename);
            //salva
            $produto = Produto::create([
                'descricao' => $request['descricao'],
                'valor' => $request['valor'],
                'id_categorias' => $request['id_categorias'],
                'imagem' => $filePath,
            ]);
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
        //aqui vc esta editando um ÚNICO produto.. logo é desncessário pegar todos da base n acha?
        // $produto=Produto::all();

        //vc seta estas variáveis mas não usa de fato.. pq ?
        // $categoria=Categoria::all();

        return view('produtos.formulario')
            ->with('produto', $produto)
            ->with('categorias', Categoria::all());
        //return view('produtos.formulario', ['produto' => $produto]);
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
        $this->validate($request, [
            'descricao' => 'required',
            'valor' => 'required',
            'id_categorias' => 'required'
        ]);
        
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            
            if (Storage::exists($produto->imagem)) {
                Storage::delete($produto->imagem);
                $produto->imagem = null;
            }

            $filename = $request->file('imagem')->store('public');

            $produto->fill($request->all());
            $produto->imagem = $filename;
            $produto->update();
        } else {
            $produto->update($request->all());
        }
        
        // $produto->save();

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
        $produto->delete();
        \Session::flash('mensagem_sucesso_produtos', 'Produto deletado!');
        return back();
    }
}
