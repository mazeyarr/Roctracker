@extends('layouts.app')

@section('title', 'Oude Teamleiders veranderen')

@section('page-title', 'Oude Teamleiders veranderen')

@section('content')
    {!! Form::open(['route' =>  array('add_teamleader_change_save_exchange'), 'data-toggle' => 'validator', 'id' => 'form']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning"> {{ $notify }} </div>
        </div>
    </div>
    <div class="row">
        <?php $i = 1; ?>
        @foreach($teamleaders as $teamleader)
            <div class="col-md-12 el_teamleader">
                <div class="white-box">
                    <h3 class="box-title m-b-30">{{ $teamleader['teamleader']->name }}</h3>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="teamleader-{{$i}}-college">College</label>
                                <div class="input-group college-container">
                                    <div class="input-group-addon"><i class="ti-briefcase"></i></div>
                                    <input type="hidden" name="teamleader-{{$i}}-id" value="{{ $teamleader['teamleader']->id }}">
                                    <input type="hidden" name="teamleader-{{$i}}-attention" value="{{ $teamleader['attention_id'] }}">
                                    <select class="form-control" name="teamleader-{{$i}}-college" id="teamleader-{{$i}}-college">
                                        <option value="Geen"> Geen </option>
                                        @foreach ($colleges as $college)
                                            <option value="{{ $college->id }}"> {{ $college->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $i++; ?>
        @endforeach
    </div>
    {!! Form::close() !!}
    <div class="row">
        <div class="col-md-12">
            <button id="save" class="btn btn-success btn-block"><i class="fa fa-save"></i> Veranderingen Opslaaan</button>
        </div>
    </div>
@stop

@section('scripts')
    @include('partials._javascript-alerts')

    <script type="text/javascript">
        $(document).ready(function () {
            var btnSave = $('#save'),
                form = $('#form'),
                elements = $('.el_teamleader'),
                numElements = null,
                url = form.attr('action');

            btnSave.click(function () {
                numElements = elements.length;
                url = url + "/"+numElements;
                form.attr('action', "");
                form.attr('action', url);
                form.submit();
            })
        });
    </script>
@stop