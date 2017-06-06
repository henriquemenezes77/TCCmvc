<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
        return view('categorias.lista',['categorias'=>$categoria]);
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
            'descricao' => 'required|min:6|max:20',
        ]);
        

        //vc pode criar o objeto assim (desde que vc configure os valores fillable no model)
        Categoria::create($request->all());

        // $categoria = Categoria::create([
        //     'descricao' => $request['descricao'],
        // ]);

        \Session::flash('mensagem_sucesso_categoria', 'Categoria cadastrada com sucesso!!');
        return Redirect::to('categorias');
    }

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
        //só uma vez ja funciona :)
        $categoria->update($request->all());
        // $categoria->update([
        //     'descricao' => $request['descricao'],
        // ]);
        \Session::flash('mensagem_sucesso_categoria', 'Categoria atualizada com sucesso!!');
        return Redirect::to('categorias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        \Session::flash('mensagem_sucesso_categoria','Deletado com sucesso!');
        return back();
    }
}
