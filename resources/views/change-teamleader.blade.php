@extends('layouts.app')

@section('title', 'Teamleider Aanpassen')

@section('page-title', $teamleader->name.' Aanpassen')

@section('content')
    <!-- .row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">{{ $teamleader->name }}</h3>
                <p class="text-muted m-b-30"></p>
                {!! Form::open(['route' =>  array('save_change_teamleaders', $teamleader->id), 'data-toggle' => 'validator']) !!}
                <div class="form-group">
                    <label for="inputName1" class="control-label">Naam:</label>
                    {!! Form::text('name', $teamleader->name, array('class' => 'form-control', 'required' => '')) !!}
                </div>
                <div class="form-group">
                    <label for="inputName1" class="control-label">E-mail:</label>
                    {!! Form::text('email', $teamleader->email, array('class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <input name="change_college" type="checkbox" id="college_change" data-error="Vink de voorwaarden aan om de wijziging door te voeren">
                        <label for="college_change"> College wijzeging ? </label>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div id="college_change_selectbox" class="form-group" style="display: none;">
                    <label for="inputName1" class="control-label">Hoe moet de college wijzeging worden uitgevoerd ?</label>
                    <div class="form-group">
                        @if(!is_null($assigned))
                            <div class="radio">
                                <input class="college_change_options" type="radio" id="college_option1" name="college_option" value="replace" required>
                                <label for="college_option1"> Vervangen </label>
                            </div>
                        @endif
                        <div class="radio">
                            <input class="college_change_options" type="radio" id="college_option2" name="college_option" value="add" required>
                            <label for="college_option2"> Toevoegen </label>
                        </div>
                        @if(!is_null($assigned))
                            <div class="radio">
                                <input class="college_change_options" type="radio" id="noCollege" name="college_option" value="none" required>
                                <label for="noCollege"> Geen college </label>
                            </div>
                        @endif
                    </div>
                    @if(!is_null($assigned))
                        <div id="current_colleges">
                            <label for="view_current_colleges" class="control-label">Colleges van {{ $teamleader->name }}</label>
                            {!! $i = 1 !!}
                            @foreach($assigned['colleges'] as $assigned_college)
                                <div class="form-group">
                                    @if($assigned['count'] > 1)
                                        <select class="form-control" name="college{{$i}}" id="view_current_colleges">
                                        {!! $i++ !!}
                                    @else
                                        <select class="form-control" name="college1" id="view_current_colleges">
                                    @endif
                                        <option value="{{ $assigned_college->id }}"> {{ $assigned_college->name }} </option>
                                        @foreach ($colleges as $college)
                                            @if($college->id != $assigned_college->id)
                                                <option value="{{ $college->id }}"> {{ $college->name }} </option>
                                            @endif
                                        @endforeach
                                        <option value="none">Geen</option>
                                    </select>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div id="all_colleges" style="display: none;">
                        <label for="view_all_colleges" class="control-label">Alle Colleges</label>
                        <div class="form-group">
                            <select class="form-control" name="college_add" id="view_all_colleges">
                                @foreach ($colleges as $college)
                                    @if(!is_null($assigned))
                                        @if($college->id != $assigned_college->id)
                                            <option value="{{ $college->id }}"> {{ $college->name }} </option>
                                        @endif
                                    @else
                                        <option value="{{ $college->id }}"> {{ $college->name }} </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="checkbox">
                        <input type="checkbox" id="terms" data-error="Vink de voorwaarden aan om de wijziging door te voeren" required>
                        <label for="terms"> Ik ga ermee akkoord dat ik deze wijziging met gezond verstand heb gemaakt. </label>
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

@section('scripts')
    @include('partials._javascript-alerts')
    <script>
        var animationSpeed = 500;
        $('#college_change').change(function () {
            if ($('input#college_change').is(':checked')) {
                $('#college_change_selectbox').show(animationSpeed);
            }else {
                $('#college_change_selectbox').hide(animationSpeed);
            }
        });

        $('.college_change_options').click(function() {
            if($('#noCollege').is(':checked')) {
                if ($('#current_colleges').is(":visible")) {
                    $('#current_colleges').hide(animationSpeed);
                }
                if ($('#all_colleges').is(":visible")) {
                    $('#all_colleges').hide(animationSpeed);
                }
            }
            else if ($('#college_option2').is(':checked')) {
                $('#current_colleges').hide(animationSpeed);
                $('#all_colleges').show(animationSpeed);
            }
            else {
                if (!$('#current_colleges').is(":visible")) {
                    $('#current_colleges').show(animationSpeed);
                }
                if ($('#all_colleges').is(":visible")) {
                    $('#all_colleges').hide(animationSpeed);
                }
            }
        });
    </script>
@stop