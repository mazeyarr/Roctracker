@extends('layouts.app')

@section('title', 'College Aanpassen')

@section('page-title', $colleges['college']->name.' Aanpassen')

@section('content')
    <!-- .row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">{{ $colleges['college']->name }}</h3>
                <p class="text-muted m-b-30"></p>
                {!! Form::open(['route' =>  array('save_change_colleges', $colleges['college']->id), 'data-toggle' => 'validator']) !!}
                    <div class="form-group">
                        <label for="inputName1" class="control-label">Naam:</label>
                        {!! Form::text('name', $colleges['college']->name, array('class' => 'form-control', 'required' => '')) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputName1" class="control-label">Locatie:</label>
                        {!! Form::text('location', $colleges['college']->location, array('class' => 'form-control', 'required' => '')) !!}
                    </div>
                    <hr>
                    <label for="inputName1" class="control-label">Wat moet er gebeuren met de assessoren ?</label>
                    <div class="form-group">
                        <div class="radio">
                            <input type="radio" id="assessor1" name="assessor_option" value="selection" required>
                            <label for="assessor1"> Selectief plaatsen in college(s) </label>
                        </div>
                        <div class="radio">
                            <input type="radio" id="assessor2" name="assessor_option" value="overwrite" required>
                            <label for="assessor2"> Meenemen in deze wijziging </label>
                        </div>
                        <div class="radio">
                            <input type="radio" id="assessor3" name="assessor_option" value="disable" required>
                            <label for="assessor3"> uitschakelen </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <input type="checkbox" id="terms" data-error="Vink de voorwaarden aan om de wijziging door te voeren" required>
                            <label for="terms"> Ik ga ermee akkoord dat ik deze wijziging met gezond verstand heb gemaakt </label>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Wijziging doorvoeren</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- /.row -->
@stop