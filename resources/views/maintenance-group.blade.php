@extends('layouts.app')

@section('title', 'Groepen Maken / Wijzigen')

@section('page-title', 'Groepen Maken / Wijzigen')

@section('content')
    <div class="row">
        <div class="col-md-12" id="panelContainer">
            @if(!empty($maintenancedata))
                @foreach($maintenancedata as $group)
                    <div class="panel panel-info">
                        <div class="panel-heading"> {{ $group->title }}
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                <h4>Deelnemers</h4>
                                <tr>
                                    <th>#</th>
                                    <th>Naam</th>
                                    <th>College</th>
                                    <th>Teamleider</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @if(!empty($group->participants->participants))
                                        @foreach($group->participants->participants as $assessor)
                                            <tr>
                                                <th scope="row">{{$i}}</th>
                                                <td>{{ $assessor->name }}</td>
                                                <td>{{ empty(\App\College::find($assessor->fk_college)) ? "Geen" : \App\College::find($assessor->fk_college)->name }}</td>
                                                <td>{{ empty(\App\Teamleaders::find($assessor->fk_teamleader)) ? "Geen" : \App\Teamleaders::find($assessor->fk_teamleader)->name }}</td>
                                            </tr>
                                            <?php $i++ ?>
                                        @endforeach
                                        @for($spots = (16 - count($group->participants->participants)); $spots > 0; $spots-- )
                                            <tr>
                                                <th scope="row">{{$i}}</th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <?php $i++ ?>
                                        @endfor
                                    @else
                                        @for($spots = 16; $spots > 0; $spots-- )
                                            <tr>
                                                <th scope="row">{{$i}}</th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <?php $i++ ?>
                                        @endfor
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <button id="btnSave" class="btn btn-success btn-circle btn-xl" style="padding-top: 15px;"><i class="fa fa-save"></i> </button>
        </div>
        <div class="col-sm-6">
            <button id="btnAddGroup" class="btn btn-primary btn-circle btn-xl" style="float: right; padding-top: 15px;"><i class="fa fa-plus"></i> </button>
        </div>
    </div>
@stop

@section('scripts')
    @include('partials._javascript-alerts')
    <script type="text/javascript">
        $(function(){
            $('.panel').lobiPanel({
                sortable: true,
                reload: false,
                editTitle: false,
                state: "collapsed"
            });
        });
        $(document).ready(function () {
            var container = $('#panelContainer'),
                btnAddGroup = $('#btnAddGroup'),
                btnSave = $('#btnSave'),
                panels = $('.panel');

            panels.on('beforeClose.lobiPanel', function(ev, lobiPanel){
                // TODO: IF PRESS ON CLOSE ALERT IF USER IS SURE TO DELETE GROUP
            });

            btnAddGroup.click(function () {
                $.getJSON('{!! URL::route('ajax_maintenance_add_group') !!}', function(data) {
                    container.append(data);
                    $('.panel').lobiPanel({
                        sortable: true,
                        close: true,
                        reload: false,
                        editTitle: false,
                        state: "collapsed"
                    });
                })
                .done(function() {
                    console.log( "second success" );
                })
                .fail(function() {
                    console.log( "error" );
                })
                .always(function() {
                    console.log( "complete" );
                });
            });
        });
    </script>
@stop