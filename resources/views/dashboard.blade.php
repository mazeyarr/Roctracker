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
                                <i class="linea-icon linea-basic" data-icon="&#xe019;"></i>
                                <h5 class="text-muted vb">Actieve Assesoren</h5>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h3 class="counter text-right m-t-15 text-danger">{{ $counta }}</h3>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="progress">
                                    <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" class="progress-bar progress-bar-danger" role="progressbar" style="width: 100%">
                                        <span class="sr-only"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 row-in-br">
                        <div class="col-in row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <i class="linea-icon linea-basic" data-icon="&#xe015;"></i>
                                <h5 class="text-muted vb">Aantal Teamleiders</h5>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h3 class="counter text-right m-t-15 text-primary">{{ $countt }}</h3>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="progress">
                                    <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" class="progress-bar progress-bar-primary" role="progressbar" style="width: 100%">
                                        <span class="sr-only"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 b-0">
                        <div class="col-in row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <i class="linea-icon linea-basic" data-icon="R"></i>
                                <h5 class="text-muted vb">Aantal Colleges</h5>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h3 class="counter text-right m-t-15 text-success">{{ $countc }}</h3>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="progress">
                                    <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" class="progress-bar progress-bar-success" role="progressbar" style="width: 100%">
                                        <span class="sr-only"></span>
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
    <div class="row" id="generalChartRow">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">Algemene Grafiek</h3>
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

    <div class="row" id="assessorChartRow">
        <div class="col-md-6 col-lg-6 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">Asssoren Data <i>({{ date('Y') }})</i></h3>
                <div class="flot-chart">
                    <div class="flot-chart-content" id="assessorCurrentChart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">Asssoren Data <i>({{ date('Y') - 1 }})</i></h3>
                <div class="flot-chart">
                    <div class="flot-chart-content" id="assessorHistoryChart"></div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('scripts')
    <!-- Custom Theme JavaScript -->
    <script src="{!! URL::asset('js/custom.min.js') !!}"></script>
    <!-- Flot Charts JavaScript -->
    <script src="{!! URL::asset('plugins/bower_components/flot/excanvas.min.js') !!}"></script>
    <script src="{!! URL::asset('plugins/bower_components/flot/jquery.flot.js') !!}"></script>
    <script src="{!! URL::asset('plugins/bower_components/flot/jquery.flot.pie.js') !!}"></script>

    <script src="{!! URL::asset('plugins/bower_components/flot/jquery.flot.time.js') !!}"></script>
    <script src="{!! URL::asset('plugins/bower_components/flot/jquery.flot.stack.js') !!}"></script>
    <script src="{!! URL::asset('plugins/bower_components/flot/jquery.flot.crosshair.js') !!}"></script>
    <script src="{!! URL::asset('plugins/bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js') !!}"></script>
    <script src="{!! URL::asset('js/flot-data.js') !!}"></script>

    <script>
        var el_generalChart = $('#generalChartRow'),
            el_assessorChartPie = $('#assessorChartRow'),
            oparation;
        getData('{{ URL::route('ajax_history_data_get') }}', el_generalChart);
        getData('{{ URL::route('ajax_assessor_data_get') }}', el_assessorChartPie);

        function getData(url, element) {
            $.getJSON( url, function( data ) {
                if (data.length <= 0) {
                    $.toast({
                        heading: 'Warning'
                        , text: 'Geen data ontvangen...'
                        , position: 'top-right'
                        , loaderBg: '#ff6849'
                        , icon: 'warning'
                        , hideAfter: 2500
                        , stack: 6
                    });
                    element.hide();
                    return false;
                }else {
                    if (url.toLowerCase().indexOf("history") >= 0) oparation = "history";
                    if (url.toLowerCase().indexOf("assessor") >= 0) oparation = "assessor";
                    switch (oparation) {
                        case "history":
                            makeGeneralChart(data);
                            break;
                        case "assessor":
                            makeHistoryAssessorChart(data.past);
                            makeCurrentAssessorChart(data.current);
                            ShowHide(el_assessorChartPie);
                            break;
                        default:
                            break;
                    }
                }
            }).error(function() {
                $.toast({
                    heading: 'Error'
                    , text: 'Laden van data mislukt !'
                    , position: 'top-right'
                    , loaderBg: '#ff6849'
                    , icon: 'error'
                    , hideAfter: 3500
                    , stack: 6
                });
            });
        }
        
        function makeGeneralChart ( data ) {
            var nodes = [];
            $.each( data , function( key, node ) {
                nodes.push(
                    {
                        period: node.year,
                        assessors: node.c_assessors,
                        teamleaders: node.c_teamleaders,
                        colleges: node.c_colleges
                    }
                );
            });

            var generalChartObject = Morris.Area({
                element: 'morris-area-chart',
                data: nodes,
                xkey: 'period',
                ykeys: ['assessors', 'teamleaders', 'colleges'],
                labels: ['Assessoren', 'Colleges', 'Teamleiders'],
                pointSize: 5,
                fillOpacity: 0,
                pointStrokeColors:['#00bfc7', '#fb9678', '#9675ce'],
                behaveLikeLine: true,
                gridLineColor: 'rgba(255, 255, 255, 0.1)',
                lineWidth: 3,
                gridTextColor:'#96a2b4',
                hideHover: 'auto',
                lineColors: ['#00bfc7', '#fb9678', '#9675ce'],
                resize: true
            });

            ShowHide(el_generalChart);
        }
        
        function makeHistoryAssessorChart ( data ) {

            var nodes = decodePieJsonData(data);

            var HistoryAssessorCharObject = $.plot($("#assessorHistoryChart"), nodes, {
                series: {
                    pie: {
                        innerRadius: 0.4,
                        show: true
                    }
                },
                grid: {
                    hoverable: true,
                    backgroundColor: '#353c48'
                },
                yaxis : {

                    font : {
                        color : '#96a2b4'
                    }
                },
                xaxis : {

                    font : {
                        color : '#96a2b4'
                    }
                },
                color: null,
                tooltip: true,
                tooltipOpts: {
                    content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
                    shifts: {
                        x: 20,
                        y: 0
                    },
                    defaultTheme: false
                }
            });
        }
        
        function makeCurrentAssessorChart ( data ) {
            var nodes = decodePieJsonData(data);

            var currentAssessorCharObject = $.plot($("#assessorCurrentChart"), nodes, {
                series: {
                    pie: {
                        innerRadius: 0.4,
                        show: true
                    }
                },
                grid: {
                    hoverable: true,
                    backgroundColor: '#353c48'
                },
                yaxis : {

                    font : {
                        color : '#96a2b4'
                    }
                },
                xaxis : {

                    font : {
                        color : '#96a2b4'
                    }
                },
                color: null,
                tooltip: true,
                tooltipOpts: {
                    content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
                    shifts: {
                        x: 20,
                        y: 0
                    },
                    defaultTheme: false
                }
            });

            return true;
        }
        
        function decodePieJsonData(json) {
            var nodes = [];
            $.each( json.data , function( key, node ) {
                nodes.push(
                    {
                        label: node.label,
                        data: node.data,
                        color: node.color
                    }
                );
            });
            return nodes;
        }

        function ShowHide(element) {
            element.fadeOut('fast');
            element.fadeIn(1500);
        }
    </script>
@stop