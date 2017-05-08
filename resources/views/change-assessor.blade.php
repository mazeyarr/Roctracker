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
                        <label for="inputEmail" class="control-label">Email:</label>
                        {!! Form::email('email', $assessor->email, array('id' => 'inputEmail', 'class' => 'form-control', 'required' => '')) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputName1" class="control-label">Team:</label>
                        {!! Form::text('team', $assessor->team, array('class' => 'form-control', 'required' => '')) !!}
                    </div>
                    <div class="form-group">
                        <h3 class="box-title m-b-0">Status</h3>
                        <div class="radio radio-success">
                            {!! Form::radio('status',1, $assessor->status == 1 ? true : false, array('id' => 'status_actieve', 'required' => '') ) !!}
                            <label for="status_actieve"> Actief </label>
                        </div>
                        <div class="radio radio-danger">
                            {!! Form::radio('status',0, $assessor->status == 1 ? false : true, array('id' => 'status_inactieve', 'required' => '') ) !!}
                            <label for="status_inactieve"> Non-actief </label>
                        </div>
                    </div>
                    <hr>
                        <div class="form-group">
                            <select class="form-control" name="college" id="current_college">
                                @if(!empty($assessor->fk_college))
                                    <option value="{{ $assessor->fk_college->id }}"> {{ $assessor->fk_college->name }} </option>
                                @endif
                                @foreach ($colleges as $college)
                                    @if(empty($assessor->fk_college))
                                        <option value="{{ $college->id }}"> {{ $college->name }} </option>
                                    @elseif($college->id != $assessor->fk_college->id)
                                        <option value="{{ $college->id }}"> {{ $college->name }} </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    <hr>
                    <h3 class="box-title m-b-0">Basistraining</h3>
                    @if($assessor->fk_exams['basictraining']->passed)
                        <div class="form-group">
                            <button id="btnBasictraining" class="btn btn-block btn-primary btn-rounded" data-status="hidden">Weergeven</button>
                        </div>
                    @endif
                    <div id="hideIfDone" style="{!! $assessor->fk_exams['basictraining']->passed ? "display:none;" : "" !!}">
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
                                <label for="inputName1" class="control-label">Dag 1: (dd-mm-yyyy)</label>
                                {!! Form::text('day1', $assessor->fk_exams['basictraining']->date1->date, array('class' => 'form-control')) !!}
                            </div>
                            <hr>
                            <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="present_day_2" id="day_2" {!! ($assessor->fk_exams['basictraining']->date2->present) ? "checked" : "" !!}> <label for="day_2"> Present</label>
                            </div>
                            <div class="form-group">
                                <label for="inputName1" class="control-label">Dag 2: (dd-mm-yyyy)</label>
                                {!! Form::text('day2', $assessor->fk_exams['basictraining']->date2->date, array('class' => 'form-control')) !!}
                            </div>
                            <div class="form-group">
                                <label for="inputName1" class="control-label">Examendag (dd-mm-yyyy)</label>
                                {!! Form::text('graduationday', $assessor->fk_exams['basictraining']->graduationday, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox checkbox-success">
                                <input type="checkbox" name="graduated" id="Geslaagd" {!! $assessor->fk_exams['basictraining']->passed ? "checked" : "" !!}> <label for="Geslaagd"> Geslaagd</label>
                            </div>
                        </div>
                        <br>
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

@section('scripts')
    <script src="{!! URL::asset('js/mask.js') !!}"></script>
    @include('partials._javascript-alerts')
    @include('partials._javascript-paddingfixer')
    <script>
        $(document).ready(function () {
            $('#btnBasictraining').click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                console.log($(this).data('status'));
                if ($(this).attr('data-status') == "hidden") {
                    $('#hideIfDone').slideDown("fast");
                    $(this).attr('data-status', 'visable');
                    $(this).html("Verbergen");
                }else {
                    $('#hideIfDone').slideUp("fast");
                    $(this).attr('data-status', 'hidden');
                    $(this).html("Weergeven");
                }
            })
        })
    </script>
@stop