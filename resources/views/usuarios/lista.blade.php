@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Usuarios
                        <a class="pull-right" href="{{url('usuarios/novo')}}">Novo Usuario</a>
                    </div>

                    <div class="panel-body">
                        @if(Session::has('mensagem_sucesso'))
                            <div class="alert alert-success">{{Session::get('mensagem_sucesso')}}</div>
                        @endif
                        @if(Session::has('msg_erro'))
                            <div class="alert alert-danger">{{Session::get('msg_erro')}}</div>
                        @endif
                        <table class="table">
                            <th>Nome:</th>
                            <th>E-mail:</th>
                            <th>Ações:</th>
                            <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <a href="{{route('usuarios.editar', $user->id)}}" class="btn btn-default btn-sm">Editar</a>
                                    <a href="{{route('usuarios.deletar', $user->id)}}" class="btn btn-default btn-sm" >Excluir</a>
                                </td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
