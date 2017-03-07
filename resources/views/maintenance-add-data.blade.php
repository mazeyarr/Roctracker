@extends('layouts.app')

@section('title', 'Onderhouds Datums invoeren')

@section('page-title', 'Onderhouds Datums invoeren')

@section('content')
    {!! Form::open(['route' =>  array('add_maintenance_dates_post', 1), 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <div class="row">
                        <div class="col-sm-11">
                            <div id="containerDates">
                                <div class="form-group">
                                    <label for="maintenance-institution-1" class="control-label">Instelling</label>
                                    {!! Form::text('institution-1',  null, array('class' => 'form-control', 'id' => 'maintenance-institution-1', 'required' => '')) !!}
                                    <label for="maintenance-location-1" class="control-label m-t-10">Locatie</label>
                                    {!! Form::text('location-1',  null, array('class' => 'form-control', 'id' => 'maintenance-location-1', 'required' => '')) !!}
                                    <label for="maintenance-date-from-1" class="control-label m-t-10">Van</label>
                                    {!! Form::text('date-from-1',  null, array('data-mask' => '99/99/9999 - 99:99', 'class' => 'form-control', 'id' => 'maintenance-from-1', 'required' => '')) !!}
                                    <label for="maintenance-date-till-1" class="control-label m-t-10">Tot</label>
                                    {!! Form::text('date-till-1',  null, array('data-mask' => '99/99/9999 - 99:99', 'class' => 'form-control', 'id' => 'maintenance-till-1', 'required' => '')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <button type="button" id="btnAddDate" class="btn btn-primary btn-circle btn-xl" style="float: right; padding-top: 15px; margin-top: 5px;"><i class="fa fa-plus"></i> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <button type="submit" id="btnSave" class="btn btn-success btn-block"><i class="fa fa-save"></i> Opslaan </button>
            </div>
        </div>
    {!! Form::close() !!}
@stop

@section('scripts')
    <script src="{!! URL::asset('js/mask.js') !!}"></script>
    @include('partials._javascript-alerts')

    <script type="text/javascript">
        $(document).ready(function (e) {
            var btnAddDate = $('#btnAddDate'),
                btnSave = $('#btnSave'),
                form = $('#form'),
                container = $('#containerDates'),
                count = null;

            btnAddDate.click(function (e) {
                e.preventDefault();
                e.stopPropagation();

                childCounter(container);
                var tempCount = count+1;

                container.append('' +
                    '<div class="form-group">' +
                        '<hr>' +
                            'Datum '+tempCount +
                        '<hr>' +
                        '<label for="maintenance-institution-'+tempCount+'" class="control-label">Instelling</label>' +
                        '<input class="form-control" id="maintenance-institution-'+tempCount+'" required="" name="institution-'+tempCount+'" type="text">'+
                        '<label for="maintenance-location-'+tempCount+'" class="control-label m-t-10">Locatie</label>' +
                        '<input class="form-control" id="maintenance-location-'+tempCount+'" required="" name="location-'+tempCount+'" type="text">'+
                        '<label for="maintenance-date-from-'+tempCount+'" class="control-label m-t-10">Van</label>' +
                        '<input data-mask="99/99/9999 - 99:99" class="form-control" id="maintenance-from-'+tempCount+'" required="" name="date-from-'+tempCount+'" type="text">'+
                        '<label for="maintenance-date-till-'+tempCount+'" class="control-label m-t-10">Tot</label>' +
                        '<input data-mask="99/99/9999 - 99:99" class="form-control" id="maintenance-till-'+tempCount+'" required="" name="date-till-'+tempCount+'" type="text">' +
                    '</div>');
            });

            btnSave.click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                var url = "{!! URL::route('add_maintenance_dates_post', null) !!}";
                childCounter(container);
                form.attr('action', url+"/"+count);
                form.submit();
                form.reset();
            });
            
            function childCounter(element) {
                count = element.children().length;
            }
        });
    </script>
@stop