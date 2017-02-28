@extends('layouts.app')

@section('title', 'Assessoren Toevoegen')

@section('page-title', 'Assessoren Toevoegen')

@section('content')
    <div class="row" style="margin-bottom: 15px;">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h4><span class="label label-info"> Hoe wilt u de Assessor(s) toevoegen...?</span></h4>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <button id="Manual" class="btn btn-primary btn-block" style="height: 500px;">
                <span style="font-size: 50px;"><i class="fa fa-plus"></i> Manueel</span>
            </button>
        </div>
        <div class="col-md-6">
            <button id="Automatic" class="btn btn-success btn-block" style="height: 500px;">
                <span style="font-size: 50px;"><i class="fa fa-file-excel-o"></i> Automatisch</span>
            </button>
        </div>
    </div>
@stop

@section('scripts')
    @include('partials._javascript-alerts')
    @include('partials._javascript-paddingfixer')

    <script type="text/javascript">
        $( document ).ready(function () {
            var btnManual = $('#Manual'),
                btnAutomatic = $('#Automatic');

            btnManual.click(function (e) {
                e.preventDefault();
                window.location.href = "{!! URL::route('add_assessor_manual') !!}";
                return true;
            });

            btnAutomatic.click(function (e) {
                e.preventDefault();
                window.location.href = "{!! URL::route('add_assessor_automatic') !!}";
                return true;
            });
        });
    </script>
@stop