@extends('layouts.app')

@section('title', 'College Toevoegen')

@section('page-title', 'College Toevoegen')

@section('content')
    {!! Form::open(['route' =>  array('save_new_college'), 'data-toggle' => 'validator', 'id' => 'form', 'class' => 'floating-labels']) !!}
    <div id="CollegeContainer">
        <div class="row el_count">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Vul de velden hieronder in</h3>
                    <div class="form-group m-b-30 m-t-20">
                        <input type="text" name="name" class="form-control" id="_name" required>
                        <span class="highlight"></span> <span class="bar"></span>
                        <label for="_name">College Naam</label>
                    </div>
                    <div class="form-group m-b-40">
                        <input type="text" name="location" class="form-control" id="_location" required>
                        <span class="highlight"></span> <span class="bar"></span>
                        <label for="_location">Locatie</label>
                    </div>
                    <div class="form-group">
                        <select class="form-control p-0" id="_teamleader" name="teamleader" required>
                            <option value="geen">Geen</option>
                            @if(!empty($teamleaders))
                                @foreach($teamleaders as $teamleader)
                                    <option value="{{ $teamleader->id }}">{{ $teamleader->name }}</option>
                                @endforeach
                            @endif
                        </select><span class="highlight"></span> <span class="bar"></span>
                        <label for="_teamleader">Teamleider</label>
                    </div>
                </div>
            </div>
        </div>
        <!--./row-->
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" id="save" class="btn btn-success btn-block"><i class="fa fa-save"></i> Opslaan</button>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('scripts')
    <script src="{!! URL::asset('js/mask.js') !!}"></script>
    @include('partials._javascript-alerts')
    @include('partials._javascript-paddingfixer')
@stop