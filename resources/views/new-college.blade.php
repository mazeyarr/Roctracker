@extends('layouts.app')

@section('title', 'College toevoegen')

@section('page-title', 'College toevoegen')

@section('content')
    @include('partials._errors')
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">Nieuw College toevoegen.</h3>
                <p class="text-muted m-b-30 font-13"> Voer de nodige informatie in het college </p>
                {!! Form::open(['route' => 'new_college', 'class' => 'form-horizontal form-material', 'data-toggle' => 'validator']) !!}
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">College naam:</label>
                    <div class="col-sm-9">
                        {!! Form::text('name', null, ['id' => 'enter-name', 'class' => 'form-control','required' => '', 'placeholder' => 'College naam']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="enter-location" class="col-sm-3 control-label">Locatie:</label>
                    <div class="col-sm-9">
                        {!! Form::text('location', null, ['id' => 'enter-location', 'class' => 'form-control', 'required' => '', 'placeholder' => 'Keizerin marialaan 2']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="choose-teamleader" class="col-sm-3 control-label">Teamleider:</label>
                    <div class="col-sm-9">
                       {{-- {!! Form::email('teamleader', null, ['class' => 'form-control', 'required' => '', 'placeholder' => '']) !!}--}}
                        <select class="form-control select-teamleader" name="teamleader" id="choose-teamleader" required>
                            <option value="default">Kies een Teamleider</option>
                            @foreach($teamleaders as $teamleader)
                                <option value="{{ $teamleader->id }}">{{ $teamleader->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-offset-3 col-sm-9">
                        {!! Form::button('Aanmaken', ['class' => 'btn btn-info waves-effect waves-light m-t-10', 'type' => 'submit']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @include('partials._javascript-alerts')
    {!! Html::script('plugins/bower_components/custom-select/custom-select.min.js') !!}
    {!! Html::script('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') !!}
    <script>
        // For select
        $(".select-teamleader").select2();
    </script>
@stop