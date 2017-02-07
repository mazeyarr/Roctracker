@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="white-box">
            <div class="row row-in">
                <div class="col-lg-4 col-sm-6 row-in-br">
                    <div class="col-in row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <i class="linea-icon linea-basic" data-icon="E"></i>
                            <h5 class="text-muted vb">Actieve Assesoren</h5>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <h3 class="counter text-right m-t-15 text-danger">{{ $counta }}</h3>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="progress">
                                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" class="progress-bar progress-bar-danger" role="progressbar" style="width: 40%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 row-in-br">
                    <div class="col-in row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <i class="linea-icon linea-basic" data-icon="&#xe00b;"></i>
                            <h5 class="text-muted vb">Aantal Teamleiders</h5>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <h3 class="counter text-right m-t-15 text-primary">157</h3>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="progress">
                                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" class="progress-bar progress-bar-primary" role="progressbar" style="width: 40%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 b-0">
                    <div class="col-in row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <i class="linea-icon linea-basic" data-icon="&#xe016;"></i>
                            <h5 class="text-muted vb">All PROJECTS</h5>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <h3 class="counter text-right m-t-15 text-success">431</h3>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="progress">
                                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" class="progress-bar progress-bar-success" role="progressbar" style="width: 40%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--row -->
<!-- /.row -->
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">Yearly Sales</h3>
            <ul class="list-inline text-right">
                <li>
                    <h5><i class="fa fa-circle m-r-5" style="color: #00bfc7;"></i>Assessoren</h5>
                </li>
                <li>
                    <h5><i class="fa fa-circle m-r-5" style="color: #fb9678;"></i>Colleges</h5>
                </li>
                <li>
                    <h5><i class="fa fa-circle m-r-5" style="color: #9675ce;"></i>Teamleider</h5>
                </li>
            </ul>
            <div id="morris-area-chart" style="height: 340px;"></div>
        </div>
    </div>
</div><!--row -->

@stop
@section('scripts')
    <!-- Custom Theme JavaScript -->
    {!! Html::script('js/dashboard.js') !!}
@stop