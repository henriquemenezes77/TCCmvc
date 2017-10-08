@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Produtos
                        <a class="pull-right" href="{{url('produtos/novo')}}">Novo Produto</a>
                    </div>

                    <div class="panel-body">
                        @if(Session::has('mensagem_sucesso_produtos'))
                            <div class="alert alert-success">{{Session::get('mensagem_sucesso_produtos')}}</div>
                        @endif
                        <table class="table">
                            <th>Descrição:</th>
                            <th>Valor:</th>
                            <th>Categoria:</th>
                            <th>Ações:</th>
                            <tbody>
                            @foreach($produtos as $produto)
                                <tr>
                                    <td>{{$produto->descricao}}</td>
                                    <td>{{$produto->valor}}</td>
                                    <td>{{$produto->categoria->descricao}}</td>
                                    <td>
                                        <a href="produtos/editar/{{$produto->id}}"
                                           class="btn btn-default btn-sm">Editar</a>
                                        <a href="produtos/deletar/{{$produto->id}}"
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
