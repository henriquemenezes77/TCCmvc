@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Categorias
                        <a class="pull-right" href="{{url('categorias/novo')}}">Nova Categoria</a>
                    </div>

                    <div class="panel-body">
                        @if(Session::has('mensagem_sucesso_categoria'))
                            <div class="alert alert-success">{{Session::get('mensagem_sucesso_categoria')}}</div>
                        @endif
                        <table class="table">
                            <th>Descrição:</th>
                            <th>Ações:</th>
                            <tbody>
                            @foreach($categorias as $categoria)
                                <tr>
                                    <td>{{$categoria -> descricao}}</td>
                                    <td>
                                        <a href="categorias/{{$categoria->id}}/editar"
                                           class="btn btn-default btn-sm">Editar</a>
                                        <a href="categorias/deletar/{{$categoria->id}}"
                                           class="btn btn-default btn-sm">Excluir</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
