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
                                    <label for="maintenance-date-1" class="control-label">Datum 1</label>
                                    {!! Form::text('date-1',  null, array('data-mask' => '99/99/9999', 'class' => 'form-control', 'id' => 'maintenance-date-1', 'required' => '')) !!}
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
                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-save"></i> Opslaan </button>
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
                form = $('#form'),
                container = $('#containerDates'),
                count = null;

            btnAddDate.click(function (e) {
                e.preventDefault();
                e.stopPropagation();

                childCounter(container);

                container.append('' +
                    '<div class="form-group">' +
                        '<label for="maintenance-date-'+count+'" class="control-label"> Datum '+count+'</label>' +
                        '<input data-mask="99/99/9999" class="form-control" id="maintenance-date-'+count+'" name="date-'+count+'" type="text" required>' +
                    '</div>');
            });
            
            function childCounter(element) {
                count = element.children().length +1;
            }
        });
    </script>
@stop