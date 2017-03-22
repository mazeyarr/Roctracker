@extends('layouts.app')

@section('title', 'Teamleider Manueel Toevoegen')

@section('page-title', 'Teamleider Manueel Toevoegen')

@section('content')
    {!! Form::open(['route' =>  array('add_teamleader_manual_save'), 'data-toggle' => 'validator', 'id' => 'form']) !!}
    <div id="TeamleaderContainer">
        <div class="row el_count">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0" id="teamleader-title-1"></h3>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="teamleader-1-name">Volledige Naam</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" name="teamleader-1-name" id="teamleader-1-name" placeholder="Volledige Naam" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="teamleader-1-college">College</label>
                                <div class="input-group college-container">
                                    <div class="input-group-addon"><i class="ti-briefcase"></i></div>
                                    <select class="form-control" name="teamleader-1-college" id="teamleader-1-college">
                                        <option value="Geen"> Geen </option>
                                        @foreach ($colleges as $college)
                                            <option value="{{ $college->id }}"> {{ $college->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <h3 class="box-title m-b-0">Teamleider status</h3>

                                <div class="radio radio-success">
                                    <input type="radio" name="status-1" id="status_actieve-1" value="1" required>
                                    <label for="status_actieve-1"> Actief </label>
                                </div>

                                <div class="radio radio-danger">
                                    <input type="radio" name="status-1" id="status_inactieve-1" value="0" required>
                                    <label for="status_inactieve-1"> Non-actief </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--./row-->
    </div>
    {!! Form::close() !!}
    <div class="row">
        <div class="col-md-6">
            <button id="addNew" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Nog een teamleader toevoegen</button>
        </div>
        <div class="col-md-6">
            <button id="save" class="btn btn-success btn-block"><i class="fa fa-save"></i> Opslaan</button>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{!! URL::asset('js/mask.js') !!}"></script>
    @include('partials._javascript-alerts')
    @include('partials._javascript-paddingfixer')

    <script type="text/javascript">
        $(document).ready(function (e) {
            var form = $('#form'),
                body = $('body'),
                container = $('#TeamleaderContainer'),
                collegeContainer = $('#college-container'),
                btnSave = $('#save'),
                btnNewObject = $('#addNew'),
                elementCount;

            btnSave.click(function (e) {
                e.preventDefault();
                btnSave.prop('disabled', true);
                countElements(container);
                form.attr('action', "{!! URL::route('add_teamleader_manual_save') !!}/"+elementCount);
                form.submit();
                btnSave.prop('disabled', false);
            });

            btnNewObject.click(function (e) {
                e.preventDefault();
                btnNewObject.prop('disabled', true);
                btnSave.prop('disabled', true);
                countElements(container);
                var element_id = elementCount+1;
                $.toast({
                    heading: 'info'
                    , text: 'Een moment geduld a.u.b<br> er zal zo een venster aan de onderkant worden bijgevoegd'
                    , position: 'top-right'
                    , icon: 'info'
                    , hideAfter: 3000
                    , stack: 6
                });
                $.getJSON( "{!! URL::route('ajax_get_colleges', 'select') !!}", function( data ) {
                    if (data.length <= 0) {
                        $.toast({
                            heading: 'Warning'
                            , text: 'Kan op dit moment geen teamleader toevoegen...'
                            , position: 'top-right'
                            , loaderBg: '#ff6849'
                            , icon: 'warning'
                            , hideAfter: 2500
                            , stack: 6
                        });
                        return false;
                    }else {
                        container.append('' +
                            '<div class="row el_count new-el-'+element_id+'">' +
                                '<div class="col-md-12">' +
                                    '<div class="white-box">' +
                                        '<h3 class="box-title m-b-0" id="teamleader-title-'+element_id+'"></h3>' +
                                        '<div class="row">' +
                                            '<div class="col-sm-12 col-xs-12">' +
                                                '<div class="form-group">' +
                                                    '<label for="teamleader-'+element_id+'-name">Volledige Naam</label>' +
                                                    '<div class="input-group">' +
                                                        '<div class="input-group-addon"><i class="ti-user"></i></div>' +
                                                        '<input type="text" class="form-control" name="teamleader-'+element_id+'-name" id="teamleader-'+element_id+'-name" placeholder="Volledige Naam" required>' +
                                                    '</div>' +
                                                '</div>' +
                                                '<div class="form-group">' +
                                                    '<label for="teamleader-'+element_id+'-college">College</label>' +
                                                    '<div class="input-group">' +
                                                        '<div class="input-group-addon"><i class="ti-briefcase"></i></div>' +
                                                        '<select class="form-control" name="teamleader-'+element_id+'-college" id="teamleader-'+element_id+'-college">' +
                                                            data +
                                                        '</select>' +
                                                    '</div>' +
                                                '</div>' +
                                                '<div class="form-group">' +
                                                    '<h3 class="box-title m-b-0">teamleader status</h3>' +
                                                    '<div class="radio radio-success">' +
                                                        '<input type="radio" name="status-'+element_id+'" id="status_actieve-'+element_id+'" value="1" required>' +
                                                        '<label for="status_actieve-'+element_id+'"> Actief </label>' +
                                                    '</div>' +
                                                    '<div class="radio radio-danger">' +
                                                        '<input type="radio" name="status-'+element_id+'" id="status_inactieve-'+element_id+'" value="0" required>' +
                                                        '<label for="status_inactieve-'+element_id+'"> Non-actief </label>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>');

                        btnNewObject.prop('disabled', false);
                        btnSave.prop('disabled', false);
                        countElements(container);
                    }
                }).error(function() {
                    btnSave.prop('disabled', false);
                    $.toast({
                        heading: 'Error'
                        , text: 'Excuses, Kan op dit moment geen nieuw venster toevoegen...'
                        , position: 'top-right'
                        , loaderBg: '#ff6849'
                        , icon: 'error'
                        , hideAfter: 3500
                        , stack: 6
                    });
                });
            });

            function countElements(element) {
                element.each(function(index, elem) {
                    var count;
                    count = $(this).find(".el_count").length;
                    elementCount = count;
                });
            }
        });
    </script>
@stop