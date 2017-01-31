@extends('layouts.app')

@section('title', $assessor->name.' Aanpassen')

@section('page-title', $assessor->name.' Aanpassen')

@section('content')
    <!-- .row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">{{ $assessor->name }}</h3>
                <p class="text-muted m-b-30"></p>
                {!! Form::open(['route' =>  array('save_change_assessor', $assessor->id), 'data-toggle' => 'validator']) !!}
                <div class="form-group">
                    <label for="inputName1" class="control-label">Naam:</label>
                    {!! Form::text('name', $assessor->name, array('class' => 'form-control', 'required' => '')) !!}
                </div>
                <div class="form-group">
                    <label for="inputName1" class="control-label">Team:</label>
                    {!! Form::text('team', $assessor->team, array('class' => 'form-control', 'required' => '')) !!}
                </div>
                <hr>
                    <div class="form-group">
                        <select class="form-control" name="college" id="current_college">
                            <option value="{{ $assessor->fk_college->id }}"> {{ $assessor->fk_college->name }} </option>
                            @foreach ($colleges as $college)
                                @if($college->id != $assessor->fk_college->id)
                                    <option value="{{ $college->id }}"> {{ $college->name }} </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                <hr>
                <h3 class="box-title m-b-0">Basistraining</h3>
                    <div class="form-group">
                        <div class="checkbox checkbox-info">
                            <input type="checkbox" name="Portfolio" id="Portfolio" {!! $assessor->fk_exams['basictraining']->requirements->portfolio ? "checked" : "" !!}> <label for="Portfolio"> Portfolio</label>
                        </div>
                        <div class="checkbox checkbox-info">
                            <input type="checkbox" name="CV" id="CV" {!! $assessor->fk_exams['basictraining']->requirements->CV ? "checked" : "" !!}> <label for="CV"> CV</label>
                        </div>
                        <div class="checkbox checkbox-info">
                            <input type="checkbox" name="Filmpje" id="Filmpje" {!! $assessor->fk_exams['basictraining']->requirements->video ? "checked" : "" !!}> <label for="Filmpje"> Filmpje</label>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="checkbox checkbox-primary">
                            <input type="checkbox" name="present_day_1" id="day_1" {!! ($assessor->fk_exams['basictraining']->date1->present) ? "checked" : "" !!}> <label for="day_1"> Present</label>
                        </div>
                        <div class="form-group">
                            <label for="inputName1" class="control-label">Dag 1:</label>
                            {!! Form::text('day1', $assessor->fk_exams['basictraining']->date1->date, array('class' => 'form-control')) !!}
                        </div>
                        <hr>
                        <div class="checkbox checkbox-primary">
                            <input type="checkbox" name="present_day_2" id="day_2" {!! ($assessor->fk_exams['basictraining']->date2->present) ? "checked" : "" !!}> <label for="day_2"> Present</label>
                        </div>
                        <div class="form-group">
                            <label for="inputName1" class="control-label">Dag 2:</label>
                            {!! Form::text('day2', $assessor->fk_exams['basictraining']->date2->date, array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox checkbox-success">
                            <input type="checkbox" name="graduated" id="Geslaagd" {!! $assessor->fk_exams['basictraining']->passed ? "checked" : "" !!}> <label for="Geslaagd"> Geslaagd</label>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Wijziging doorvoeren</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- /.row -->
@stop

@section('scripts')
    @include('partials._javascript-alerts')
    @include('partials._javascript-paddingfixer')
@stop