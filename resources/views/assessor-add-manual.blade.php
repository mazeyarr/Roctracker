@extends('layouts.app')

@section('title', 'Assessoren Manueel Toevoegen')

@section('page-title', 'Assessoren Manueel Toevoegen')

@section('content')
    <div id="AssessorContainer">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0" id="assessor-title-1"></h3>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            {!! Form::open(['route' =>  'add_assessor_manual_save', 'data-toggle' => 'validator']) !!}
                                <div class="form-group">
                                    <label for="assessor-1-name">Volledige Naam</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-user"></i></div>
                                        <input type="text" class="form-control" name="assessor-1-name" id="assessor-1-name" placeholder="Volledige Naam">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="assessor-1-birthdate">Geboorte datum</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-layout-grid3"></i></div>
                                        <input data-mask="99/99/9999" type="text" class="form-control" name="assessor-1-birthdate" id="assessor-1-birthdate" placeholder="Geboorte Datum">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="assessor-1-college">College</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-briefcase"></i></div>
                                        <select class="form-control" name="assessor-1-college" id="assessor-1-college">
                                            @foreach ($colleges as $college)
                                                <option value="{{ $college->id }}"> {{ $college->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="assessor-1-functie">Functie</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-clipboard"></i></div>
                                        <input type="text" class="form-control" name="assessor-1-functie" id="assessor-1-functie" placeholder="Functie">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="assessor-1-team">Team</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-bookmark-alt"></i></div>
                                        <input type="text" class="form-control" name="assessor-1-team" id="assessor-1-team" placeholder="Team">
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--./row-->
    </div>
@stop

@section('scripts')
    <script src="{!! URL::asset('js/mask.js') !!}"></script>
    @include('partials._javascript-alerts')
    @include('partials._javascript-paddingfixer')

    <script type="text/javascript">

    </script>
@stop