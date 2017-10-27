<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class CategoriasController extends Controller
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
        $categoria = Categoria::get();
        return view('categorias.lista', ['categorias' => $categoria]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function novo()
    {
        return view('categorias.formulario');
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
            'descricao' => 'unique:categorias|required|min:4|max:20'
        ]);

        //verifica se a img existe e faz a validação da mesma
            if ($request->hasFile('imagem')&& $request->file('imagem')->isValid()) {
                $filePath = $request->file('imagem')->store('public');


                $categoria = Categoria::create([
                'descricao' => $request['descricao'],
                'imagem' => $filePath,
            ]);
            \Session::flash('mensagem_sucesso_categoria', 'Categoria cadastrada com sucesso!!');
            return Redirect::to('categorias');
        } else {
            Categoria::create($request->all());
            \Session::flash('mensagem_sucesso_categoria', 'Categoria cadastrada com sucesso!!');
            return Redirect::to('categorias');
        }
    }


        //vc pode criar o objeto assim (desde que vc configure os valores fillable no model)
        //Categoria::create($request->all());
       // \Session::flash('mensagem_sucesso_categoria', 'Categoria cadastrada com sucesso!!');
       // return Redirect::to('categorias');
   // }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.formulario')->with('categoria', $categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        //atualização de produto
        $this->validate($request, [
            'descricao' => 'required',
        ]);

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {

            if (Storage::exists($categoria->imagem)) {
                Storage::delete($categoria->imagem);
                $categoria->imagem = null;
            }

            $filename = $request->file('imagem')->store('public');

            $categoria->fill($request->all());
            $categoria->imagem = $filename;
            $categoria->update();
        } else {
            $categoria->update($request->all());
        }

        \Session::flash('mensagem_sucesso_categoria', "Categoria atualizada com sucesso");
        return Redirect::to('categorias');



        //$categoria->update($request->all());
        //\Session::flash('mensagem_sucesso_categoria', 'Categoria atualizada com sucesso!!');
        //return Redirect::to('categorias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        try {
            $categoria->delete();
            \Session::flash('mensagem_sucesso_categoria', 'Deletado com sucesso!');
            return back();
        } catch (\Exception $e) {
            \Session::flash('mensagem_sucesso_categoria', 'A categoria esta vínculada a um ou mais Produtos. 
            Se desejar removê-la é preciso remover ou alterar os seus produtos.');
            return back();
        } 
    }
}
