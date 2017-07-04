<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UsuariosController extends Controller
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
        $user = User::get();
        return view('usuarios.lista',['users'=>$user]);
    }

    public function novo()
    {
        return view('usuarios.formulario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function salvar(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
        \Session::flash('mensagem_sucesso', 'Usuario cadastrado com sucesso!!');
        return Redirect::to('usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function listar($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function editar(User $user)
    {
        return view('usuarios.formulario',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function atualizar(Request $request, User $user)
    {
        //Não esquece de validar os dados do formulário
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required'
        ]);

        $user->update([
                'name' => $request['name'],
                'email' => $request['email'],
                // Não é interessante atualizar a senha do usuário assim no mais..
                // Talvez seja interessante fazer uma outra view para alterar a senha?
                // Ou então ao menos solicitar que o usuário confirme a sua própria senha para poder alterar.
                // E aqui, em vez de fazer um update direto da senha. Verificar se precisa ser alterada 
                // (talvez com um checkbox?)
                // 'password' => bcrypt($request['password']),
        ]);
        \Session::flash('mensagem_sucesso', 'Usuario atualizado com sucesso!!');
        return Redirect::to('usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        \Session::flash('mensagem_sucesso','Usuario deletado com sucesso!!');
        return back();
    }
}
