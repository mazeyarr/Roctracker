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
                    <div class="sales-bars-chart" style="width: 100%; height: 320px;"> </div>
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
    <script type="text/javascript">
        $(document).ready(function () {
            // sales bar chart
            var json  = ;

            $(function() {
                //some data
                var d1 = [];
                for (var i = 0; i <= 10; i += 1)
                    d1.push([i, parseInt(Math.random() * 60)]);

                var d2 = [];
                for (var i = 0; i <= 10; i += 1)
                    d2.push([i, parseInt(Math.random() * 40)]);

                var d3 = [];
                for (var i = 0; i <= 10; i += 1)
                    d3.push([i, parseInt(Math.random() * 25)]);

                var ds = new Array();
                console.log(d1);
                console.log(d2);
                console.log(d3);
                ds.push({
                    label : "Data One",
                    data : d1,
                    bars : {
                        order : 1
                    }
                });
                ds.push({
                    label : "Data Two",
                    data : d2,
                    bars : {
                        order : 2
                    }
                });
                ds.push({
                    label : "Data Three",
                    data : d3,
                    bars : {
                        order : 3
                    }
                });

                var stack = 0,
                    bars = true,
                    lines = true,
                    steps = true;

                var options = {
                    bars : {
                        show : true,
                        barWidth : 0.2,
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
                        font : {
                            color : '#bdbdbd'
                        }
                    },
                    xaxis : {
                        tickColor : '#353c48',
                        font : {
                            color : '#bdbdbd'
                        }
                    },
                    colors : ["#4F5467", "#01c0c8", "#fb9678"],
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
@stop
