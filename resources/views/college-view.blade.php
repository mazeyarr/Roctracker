@extends('layouts.app')

@section('title', 'College Aanpassen')

@section('page-title', $colleges['college']->name.' Aanpassen')

@section('content')
    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <ul class="timeline">
                    <?php $i=true ?>
                    @if(!empty($logs->log))
                            @foreach(array_reverse((array)$logs->log) as $log)
                            @if($i)
                                <li>
                            @else
                                <li class="timeline-inverted">
                            @endif
                                <div class="timeline-badge info"><i class="fa fa-bookmark"></i></div>
                                <div class="timeline-panel" data-log-key="{!! $log->key !!}">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">{{ $log->date }}</h4>
                                        <small style="margin-bottom: 10px;">Gewijzigd door: {{ $log->by->name }}</small>
                                    </div>
                                    <div class="timeline-body">
                                        <p>{!! $log->discription !!}</p>
                                    </div>
                                </div>
                            </li>
                            @if($i)
                                <?php $i = false ?>
                            @elseif(!$i)
                                <?php $i = true ?>
                            @endif
                        @endforeach
                    @else
                        <li>
                            <div class="timeline-badge warning"><i class="fa fa-commenting"></i></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Attentie</h4>
                                    <small></small>
                                </div>
                                <div class="timeline-body">
                                    <p>Op het moment zijn er geen grote wijzigingen plaatsgevonden, in het<br> <strong>{{ $colleges['college']->name }}</strong></p>
                                </div>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <!-- /.row -->
@stop

@section('scripts')
    @include('partials._javascript-alerts')
@stop