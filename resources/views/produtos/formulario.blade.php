@extends('layouts.app')
@section('content')
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
        <script src="jquery.maskMoney.js" type="text/javascript"></script>
    </head>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    @if(Route::is('produtos.editar'))
                        Editando produto: <strong>{{$produto->descricao}}</strong>
                    @else
                        Cadastro de novo produto
                    @endif
                        <a class="pull-right" href="{{url('produtos')}}">Listar produtos</a>                    
                    </div>
                    <div class="panel-body">
                        <script> $(function () {
                                //$('#valor').maskMoney();
                            }) </script>
                        <div class="panel-body">
                            @if(Route::is('produtos.editar'))
                                {{-- Cara.. vc mistura mto as coisa haha.. vc a url pra edição de produtos é
                                    produtos/$id .... que tem a ver a categoria?? --}}
                                {{Form::model($produto,['class' => 'form-horizontal', 'method'=>'PATCH','url'=> route('produtos.update', $produto->id), 'files' => true])}}

                                {{ Form::hidden('id') }}
                                
                                {{-- <form action="{{ route('produtos.editar', $produto->id) }}" class="form form-horizontal" role="form" enctype="multipart/form-data"> --}}
                            @else
                                {{ Form::open(['class' => 'form-horizontal', 'method' => 'POST', 'url' => route('produtos.salvar'), 'files' => true]) }}
                                {{-- <form class="form form-horizontal" role="form" method="POST"
                                enctype="multipart/form-data"
                                action="{{ route('produtos.salvar') }}"> --}}
                            @endif
                                    <div class="form-group">
                                        {!! Form::label('descricao','Descrição: ',['class' => 'control-label col-md-4']) !!}
                                        <div class="col-md-6">
                                            {!! Form::input('text','descricao',null,['class'=>'form-control {{ $errors->has("descricao") ? "has-error" : "" }}','autofocus','placeholder'=>'Descriçao']) !!}
                                        </div>
                                        @if($errors->has('name'))
                                            <span class="help-block">{{$errors->first('name')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('valor','Valor: ', ['class' => 'control-label col-md-4']) !!}
                                        <div class="col-md-6">
                                            {!! Form::input('text','valor',null,['class'=>'form-control {{$errors->has("valor") ? "has-error" : ""}}','autofocus','placeholder'=>'Valor']) !!}
                                        </div>
                                        @if($errors->has('name'))
                                            <span class="help-block">{{$errors->first('name')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('categoria','Categoria: ', ['class' => 'control-label col-md-4']) !!}
                                        <div class="col-md-6">
                                            <select name="id_categorias" id="categoria" class="form-control">
                                                @foreach($categorias as $categoria)
                                                    <option value="{{ $categoria->id }}">{{ $categoria->descricao }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if($errors->has('name'))
                                            <span class="help-block">{{$errors->first('name')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('imagem','Imagem: ', ['class' => 'control-label col-md-4']) !!}
                                        <div class="col-md-6">
                                            {!! Form::file('imagem') !!}
                                        </div>
                                    </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4"><br>
                                        <button type="submit" class="btn btn-primary ">
                                        @if(Route::is('produtos.editar'))
                                            Editar
                                        @else
                                            Cadastrar
                                        @endif
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection