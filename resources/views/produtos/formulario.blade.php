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

                        <div class="panel-body">
                            @if(Route::is('produtos.editar'))

                                {{Form::model($produto,['class' => 'form-horizontal', 'method'=>'PATCH','url'=> route('produtos.update', $produto->id),
                                'files' => true])}}

                                {{ Form::hidden('id') }}
                            @else
                                {{ Form::open(['class' => 'form-horizontal', 'method' => 'POST', 'url' => route('produtos.salvar'),
                                'files' => true]) }}
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
                                    <input type="file" name="imagem[]" multiple/>
                                </div>
                            </div>
                            @if(Route::is('produtos.editar'))
                                <div class="form-group">
                                    <div class="row">
                                        @foreach($produto->imagens as $imagem)
                                            <div class="col-xs-6 col-md-3 col-lg-2 img-wrapper">
                                                <div class="thumbnail">
                                                    <img src="{{Storage::url($imagem->imagem)}}" class="img-responsive">

                                                    <div class="caption">
                                                        <!-- GERAR ROTA PARA REMOCAO DE IMG -->
                                                        <a href="#" class="btn btn-sm btn-danger">
                                                            Remover
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

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