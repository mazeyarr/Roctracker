@extends('layouts.app')

@section('title', 'College Details')

@section('page-title', $college->name.' Details')

@section('content')
    <!-- .row -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">Actieve assessoren in {{ $college->name  }}</h3>
                <div class="flot-chart">
                    @if(empty(\App\College::AssessorsInCollege($college->id)))
                        <p class="text-info"> Er is geen data van dit college om te weergeven</p>
                    @else
                        <div class="sales-bars-chart" style="width: 100%; height: 320px;"> </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
@stop

@section('scripts')
    @include('partials._javascript-alerts')
    @include('partials._javascript-paddingfixer')
    <!-- Flot Charts JavaScript -->
    <script src="{!! URL::asset('plugins/bower_components/flot/excanvas.min.js') !!}"></script>
    <script src="{!! URL::asset('plugins/bower_components/flot/jquery.flot.js') !!}"></script>
    <script src="{!! URL::asset('plugins/bower_components/flot/jquery.flot.pie.js') !!}"></script>

    <script src="{!! URL::asset('plugins/bower_components/flot/jquery.flot.time.js') !!}"></script>
    <script src="{!! URL::asset('plugins/bower_components/flot/jquery.flot.stack.js') !!}"></script>
    <script src="{!! URL::asset('plugins/bower_components/flot/jquery.flot.crosshair.js') !!}"></script>
    <script src="{!! URL::asset('plugins/bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js') !!}"></script>

    @if(!empty(\App\College::AssessorsInCollege($college->id)))
    <script type="text/javascript">
        $(document).ready(function () {
            // sales bar chart
            var $json  = $.parseJSON('{!! \App\HistoryData::CollegeData($college->id) !!}');
            function gd(string) {
                return new Date(string).getTime();
            }
            $(function() {
                var ds = new Array();
                var itarator = 0;
                var minDate = null;
                $.each($json, function ($label, $array) {
                    $.each($array, function ($key, $val) {
                        $array[$key][0] = gd($val[0]);
                        if (minDate !== null) {
                            if (minDate > gd($val[0])) {
                                minDate = gd($val[0]);
                            }
                        }
                        console.log(gd($val[0]));
                    });
                    ds.push({
                        label : $label,
                        data : $array,
                        bars : {
                            order : itarator
                        }
                    });
                    itarator++;
                });

                var stack = 0,
                    bars = true,
                    lines = true,
                    steps = true;

                var options = {
                    bars : {
                        show : true,
                        lineWidth: 1,
                        barWidth: 24 * 60 * 60 * 70000,
                        fill : 1
                    },
                    grid : {
                        show : true,
                        aboveData : false,
                        labelMargin : 5,
                        axisMargin : 0,
                        borderWidth : 1,
                        minBorderMargin : 5,
                        clickable : true,
                        hoverable : true,
                        autoHighlight : false,
                        mouseActiveRadius : 20,
                        borderColor : '#353c48'
                    },
                    series : {
                        stack : stack
                    },
                    legend : {
                        position : "ne",
                        margin : [0, 0],
                        noColumns : 0,
                        labelBoxBorderColor : null,
                        labelFormatter : function(label, series) {
                            // just add some space to labes
                            return '' + label + '&nbsp;&nbsp;';
                        },
                        width : 30,
                        height : 5
                    },
                    yaxis : {
                        tickColor : '#353c48',
                        tickDecimals:0,
                        font : {
                            color : '#bdbdbd'
                        }
                    },
                    xaxis : {
                        tickColor : '#353c48',
                        mode: "time",

                        minTickSize: [1, "year"],
                        min: minDate,
                        max: (new Date()).getTime(),
                        font : {
                            color : '#bdbdbd'
                        }
                    },
                    colors : ["#ff5252", "#ff4081", "#e040fb", "#7c4dff", "#536dfe", "#448aff", "#18ffff", "#64ffda"],
                    tooltip : true, //activate tooltip
                    tooltipOpts : {
                        content : "%s : %y.0 ",
                        shifts : {
                            x : -30,
                            y : -50
                        }
                    }
                };
                $.plot($(".sales-bars-chart"), ds, options);
            });
        });
    </script>
    @endif
@stop
