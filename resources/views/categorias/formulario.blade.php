@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Informe uma nova categoria.
                        <a class="pull-right" href="{{url('categorias')}}">Listar categorias</a>
                    </div>
                    <div class="panel-body">

                            <div class="panel-body">
                                @if(Request::is('*/editar'))
                                    {{Form::model($categoria,['method'=>'PATCH','url'=>'categorias/'.$categoria->id])}}
                                @else
                                    {!! Form::open(['url'=>'categorias/salvar']) !!}
                                @endif

                            <div class="form-group{{ $errors->has('descricao') ? ' has-error' : '' }}">
                                <label for="descricao" class="col-md-4 control-label">Descrição:</label>

                                <div class="col-md-6">
                                @if(Request::is('*/editar'))
                                    <input type="text" id="descricao" class="form-control" name="descricao" value="{{ $categoria->descricao }}" >
                                @else
                                    <input id="descricao" type="text" class="form-control" name="descricao" value="{{ old('descricao') }}"
                                           required autofocus>
                                @endif

                                    @if ($errors->has('descricao'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4"><br>
                                    <button type="submit" class="btn btn-primary ">
                                        @if(Request::is("*/editar"))
                                            Editar
                                        @else
                                            Cadastrar
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
