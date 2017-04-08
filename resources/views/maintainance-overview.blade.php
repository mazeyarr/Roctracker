@extends('layouts.app')

@section('title', 'Onderhouds Overzicht')

@section('page-title', 'Onderhouds Overzicht')

@section('content')
    <div class="row">
        <div class="col-sm-12 m-b-10">
            <a href="{{ URL::route('maintenance_assessor_groups') }}" class="btn btn-success btn-block"><i class="fa fa-calendar"></i> Onderhouds Groepen maken / inplannen </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 bt-switch">
            <div class="white-box">
                <div class="row sales-report">
                    <div class="col-md-6 col-sm-6 col-xs-6 m-t-15">
                        <h2>Onderhoud {{date('Y') - 1}} - {{date('Y')}}</h2>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 ">
                        @if(!empty($assessors))
                        <h1 class="text-right text-success m-t-15">{{ count($assessors) }}</h1> </div>
                        @endif
                </div>
                <table id="college-footable" class="table toggle-circle table-hover">
                    <thead>
                    <tr>
                        <th data-toggle="true"> Naam </th>
                        <th> Datum </th>
                        <th> Type </th>
                        <th data-sort-ignore="true"> Afvinken </th>
                    </tr>
                    </thead>
                    <div class="form-inline padding-bottom-15">
                        <div class="row">
                            <div class="col-sm-12 text-left m-b-20">
                                <div class="form-group">
                                    <label class="form-inline"> Laat
                                        <select id="demo-show-entries" class="form-control input-sm">
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                        </select> Rijen zien.
                                    </label>
                                </div>
                                <div class="form-group" style="float: right;">
                                    <input id="footable-search" type="text" placeholder="Zoeken" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <tbody id="table-body">
                        @if(!empty($assessors))
                            @foreach($assessors as $assessor)
                                <tr style="cursor: pointer;">
                                    <td>{{ $assessor['assessor']->name }}</td>
                                    @if($assessor['type'] == "Onderhoud")
                                        <td>{{ !empty($assessor['data']->training_next_on) ? date_format(date_create($assessor['data']->training_next_on), 'd/m/Y'): '' }}</td>
                                        <td><span class="label label-success label-rouded">{{ $assessor['type'] }}</span></td>
                                    @else
                                        <td>{{ !empty($assessor['data']->exam_next_on) ? date_format(date_create($assessor['data']->exam_next_on), 'd/m/Y'): '' }}</td>
                                        <td><span class="label label-info label-danger">{{ $assessor['type'] }}</span></td>
                                    @endif
                                    <td>
                                        <div class="m-b-30 ticking_maintenance">
                                            <input id="tick-{{$assessor['assessor']->id}}" {{ $assessor['data']->maintenance_this_year == true ? "Checked" : "" }} class="radio-switch" type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="5">
                            <div class="text-right">
                                <ul class="pagination pagination-split m-t-30"> </ul>
                            </div>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @include('partials._javascript-alerts')
    <!-- Footable -->
    <script src="{{ URL::asset('plugins/bower_components/footable/js/footable.all.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
    <!--FooTable init-->
    <script src="{{ URL::asset('js/footable-init.js') }}"></script>
    <!-- bt-switch -->
    <script src="{!! URL::asset('plugins/bower_components/bootstrap-switch/bootstrap-switch.min.js') !!}"></script>
    @include('partials._javascript-paddingfixer')

    <script type="text/javascript">
        $(document).ready(function () {
            $("input[type='checkbox']").bootstrapSwitch();
            var body = $('body');
            body.on('switchChange.bootstrapSwitch', function (event, state) {
                var id_a = event.target.id;
                id_a = id_a.replace('tick-', "");
                TickOffMaintenance(state, id_a);
            });

            function TickOffMaintenance(state, id) {
                $.post( "{!! URL::route('post_tick_maintenance') !!}", { tick: state, id: id, _token: $('meta[name="csrf-token"]').attr('content') } )
                    .done(function( data ) {
                        if (data === "true") {
                            var OnOff = "",
                                status = "",
                                color = "";

                            switch (state) {
                                case true:
                                    OnOff = " afgevinkt";
                                    status = "success";
                                    color = "#ACE0AC";
                                    break;
                                case false:
                                    OnOff = " niet meer afgevinkt";
                                    status = "warning";
                                    color = "#dde044";
                                    break;
                            }
                            ezToast("Opdracht voltooid", "Assessor is" + OnOff, status, 2000, color);
                        }else{
                            ezToast("Opdracht mislukt", "Er ging iets verkeerd", "success", 2000, "#e07d69")
                        }
                });

            }
        });
    </script>
@stop