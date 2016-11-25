@if(!$errors->isEmpty())
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
    {{ die() }}
@endif
@extends('layouts.app')

@section('title', 'Administratoren')

@section('page-title', 'Administratoren')

@section('content')
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Nieuwe Administrator registreren.</h3>
            <p class="text-muted m-b-30 font-13"> Voer de nodige informatie in van de nieuwe gebruiker </p>
            {!! Form::open(['route' => 'new_user', 'class' => 'form-horizontal form-material', 'data-toggle' => 'validator']) !!}
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Volledige naam:</label>
                    <div class="col-sm-9">
                        {!! Form::text('name', null, ['class' => 'form-control','required' => '', 'placeholder' => 'Carla van Zijlen']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Email:</label>
                    <div class="col-sm-9">
                        {!! Form::email('email', null, ['class' => 'form-control', 'required' => '', 'placeholder' => 'voorbeeld@voorbeeld.nl']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">Wachtwoord:</label>
                    <div class="col-sm-9">
                        {!! Form::password('password', ['class' => 'form-control', 'required' => '', 'placeholder' => 'Wachtwoord', 'id' => 'password']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword4" class="col-sm-3 control-label">Wachtwoord bevestigen:</label>
                    <div class="col-sm-9">
                        {!! Form::password('confirm_password', ['class' => 'form-control', 'required' => '', 'placeholder' => 'Wachtwoord', 'data-match' => '#password']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox checkbox-success">
                            {!! Form::checkbox('send_mail') !!}
                            <label for="checkbox33">Email versturen ?</label>
                        </div>
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-offset-3 col-sm-9">
                        {!! Form::button('Registreren', ['class' => 'btn btn-info waves-effect waves-light m-t-10', 'type' => 'submit']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop