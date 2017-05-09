@extends('layouts.app')

@section('title', 'Standaard Berichten')

@section('page-title', 'Standaard Berichten')

@section('content')
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">Planning Assessoren
            </div>
            <div class="panel-body">
                <button onclick="ezToast('Bericht Verstuurd !', 'Het bericht was verstuurd', 'success', 1000, '#91ff7d')" class="btn btn-success btn-block">Bericht Versturen <span class="fa fa-paper-plane"></span></button>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">Uitnodiging Onderhoud
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Type Onderhoud</th>
                        <th>Team</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Exams::MaintenanceUpdate() as $maintenance)
                        <tr>
                            <td>{{$maintenance['assessor']->name}}</td>
                            <td>{{$maintenance['type']}}</td>
                            <td>{{$maintenance['assessor']->team}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <button onclick="ezToast('Bericht Verstuurd !', 'Het bericht was verstuurd', 'success', 1000, '#91ff7d')" class="btn btn-success btn-block">Bericht Verstuuren <span class="fa fa-paper-plane"></span></button>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">Uitnodiging Basistraining
            </div>
            <div class="panel-body">
                <button onclick="ezToast('Bericht Verstuurd !', 'Het bericht was verstuurd', 'success', 1000, '#91ff7d')" class="btn btn-success btn-block">Bericht Versturen <span class="fa fa-paper-plane"></span></button>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">Uitnodiging Basis Examens
            </div>
            <div class="panel-body">
                <button onclick="ezToast('Bericht Verstuurd !', 'Het bericht was verstuurd', 'success', 1000, '#91ff7d')" class="btn btn-success btn-block">Bericht Versturen <span class="fa fa-paper-plane"></span></button>
            </div>
        </div>
    </div>
    <!-- /.row -->
@stop

@section('scripts')
    @include('partials._javascript-alerts')
    <script type="text/javascript">
        $(function(){
            $('.panel').lobiPanel({
                sortable: true,
                reload: false,
                editTitle: false,
                close: false,
                state: "collapsed"
            });
        });
    </script>
@stop