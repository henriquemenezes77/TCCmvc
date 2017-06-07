@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Cadastro de novo produto</div>
                    {{-- <script src=”//code.jquery.com/jquery-1.11.3.min.js”></script> --}}
                    {{-- <script src=”//vendor/artesaos/cidades/js/scripts.js”></script> --}}
                    <div class="panel-body">
                            <a class="pull-right" href="{{url('produtos')}}">Listar produtos</a>

                            <div class="panel-body">
                                @if(Request::is('*/editar'))
                                    {{Form::model($produto,['method'=>'PATCH','url'=>'produtos/'.$produto->id])}}
                                @else
                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data"
                                action="{{url('produtos/salvar')}}">
                                @endif
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('descricao') ? ' has-error' : '' }}">
                                    <label for="descricao" class="col-md-4 control-label">Descrição:</label>

                                    <div class="col-md-6">
                                        <input id="descricao" type="text" class="form-control" name="descricao"
                                               value="{{ old('descricao') }}"
                                               required autofocus>

                                        @if ($errors->has('descricao'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('valor') ? ' has-error' : '' }}">
                                    <label for="valor" class="col-md-4 control-label">Valor:</label>

                                    <div class="col-md-6">
                                        <input id="valor" type="text" class="form-control" name="valor"
                                               value="{{ old('valor') }}"
                                               required>

                                        @if ($errors->has('valor'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('valor') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('id_categoria') ? ' has-error' : '' }}">
                                    <label for="id_categoria" class="col-md-4 control-label">Categoria:</label>

                                    <div class="col-md-6">

                                        <select id="id_categorias" class="form-control dropdown" name="id_categorias" value="{{ old('id_categoria') }}" required>

                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->descricao }}</option>
                                        @endforeach

                                        </select>


                                        @if ($errors->has('id_categoria'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('id_categoria') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('imagem') ? ' has-error' : '' }}">
                                    <label for="descricao" class="col-md-4 control-label">Imagem:</label>

                                    <div class="col-md-6">
                                        @if ($errors->has('imagem'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('imagem') }}</strong>
                                    </span>
                                        @endif
                                        <input id="imagem" type="file" name="imagem"
                                               value="{{ old('imagem') }}"
                                               required autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4"><br>
                                        <button type="submit" class="btn btn-primary ">
                                            Cadastrar
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
