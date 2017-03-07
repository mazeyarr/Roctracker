@extends('layouts.app')

@section('title', 'Groepen inplannen')

@section('page-title', 'Groepen inplannen')

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title">Drag and drop your event</h3>
                <div class="m-t-20">
                    <div class="calendar-event" data-class="bg-primary">My Event One <a href="javascript:void(0);" class="remove-calendar-event"><i class="ti-close"></i></a></div>
                    <div class="calendar-event" data-class="bg-success">My Event Two <a href="javascript:void(0);" class="remove-calendar-event"><i class="ti-close"></i></a></div>
                    <div class="calendar-event" data-class="bg-warning">My Event Three <a href="javascript:void(0);" class="remove-calendar-event"><i class="ti-close"></i></a></div>
                    <div class="calendar-event" data-class="bg-custom">My Event Four <a href="javascript:void(0);" class="remove-calendar-event"><i class="ti-close"></i></a></div>
                    <input type="text" placeholder="Add Event and hit enter" class="form-control add-event m-t-20"> </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="white-box">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @include('partials._javascript-alerts')
    {!! Html::script('plugins/bower_components/calendar/jquery-ui.min.js') !!}
    {!! Html::script('plugins/bower_components/moment/moment.js') !!}
    {!! Html::script('plugins/bower_components/calendar/dist/fullcalendar.min.js') !!}
    {!! Html::script('plugins/bower_components/calendar/dist/jquery.fullcalendar.js') !!}
    {!! Html::script('plugins/bower_components/calendar/dist/cal-init.js') !!}
@stop