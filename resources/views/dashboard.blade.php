@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')
    @if(!empty($colleges))
            <!-- .row -->
            <div class="row">
                <?php $i = 0; ?>
                @foreach($colleges as $college)
                    <div class="col-md-4 col-lg-4 col-xs-4">
                        <div class="white-box">
                            <h3 class="box-title">{{$college->name}}</h3>
                            <div id="morris-bar-chart-{{$college->id}}"></div>
                            <a href="{{ URL::route('view_college_details', $college->id) }}" class="btn btn-info btn-block"><i class="fa fa-info-circle"></i> Details</a>
                        </div>
                    </div>
                <?php $i++; ?>
                @endforeach
            </div>
            <!-- /.row -->
    @endif
@stop
@section('scripts')
    @include('partials._javascript-alerts')
    <!--Morris JavaScript -->
    <script src="{!! URL::asset('plugins/bower_components/raphael/raphael-min.js') !!}"></script>
    <script src="{!! URL::asset('plugins/bower_components/morrisjs/morris.js') !!}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var $i = "{!! $i !!}";
            $i = parseInt($i);
            @foreach($colleges as $college)
                Morris.Bar({
                    element: 'morris-bar-chart-{{$college->id}}',
                    data: [{
                        y: "{{$graph[$college->id]['current']}}",
                        a: parseInt("{{$graph[$college->id]['count']}}"),
                        b: parseInt("{{$graph[$college->id]['should']}}")
                    }],
                    xkey: 'y',
                    ykeys: ['a','b'],
                    labels: ['Actieve Assessoren', 'Te behalen'],
                    barColors:['#b8edf0', '#fcc9ba'],
                    hideHover: 'auto',
                    gridLineColor: 'rgba(120, 130, 140, 0.28)',
                    gridTextColor:'#96a2b4',
                    resize: true
                });
            @endforeach
        })
    </script>
@stop