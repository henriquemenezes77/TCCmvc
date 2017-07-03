@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Informe abaixo os dados!
                        <a class="pull-right" href="{{url('usuarios')}}">Listar Usuarios</a>
                    </div>

                    <div class="panel-body">
                        @if(Route::is('usuarios.editar'))
                            {{Form::model($user,['method'=>'PATCH','url'=>'usuarios/'.$user->id])}}
                        @else
                            {!! Form::open(['url'=>'usuarios/salvar']) !!}
                        @endif

                        <div class="form-group">
                            {!! Form::label('name','Nome: ') !!}
                            {!! Form::input('text','name',null,['class'=>'form-control {{$errors->has("nome") ? "has-error" : ""}}','autofocus','placeholder'=>'Nome']) !!}
                            @if($errors->has('name'))
                                <span class="help-block">{{$errors->first('name')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('email','E-mail: ') !!}
                            {!! Form::input('text','email',null,['class'=>'form-control','','placeholder'=>'E-mail']) !!}
                            @if($errors->has('email'))
                                <span class="help-block">{{$errors->first('email')}}</span>
                            @endif
                        </div>

                        @if(Route::is('usuarios.novo'))
                            <div class="form-group">
                                {!! Form::label('password','Senha: ') !!}
                                {!! Form::input('password','password',null,['class'=>'form-control','','placeholder'=>'Senha']) !!}
                                @if($errors->has('password'))
                                    <span class="help-block">{{$errors->first('password')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('password_confirmation','Confirme a Senha: ') !!}
                                {!! Form::input('password','password_confirmation',null,['class'=>'form-control','','placeholder'=>'Confirme a Senha']) !!}
                                @if($errors->has('password_confirmation'))
                                    <span class="help-block">{{$errors->first('password_confirmation')}}</span>
                                @endif
                            </div>
                        @endif
                        {!! Form::submit('Salvar',['class'=>'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection