@extends('layouts.app')

@section('title', 'Teamleiders')

@section('page-title', 'Teamleiders')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
                <table id="college-footable" class="table toggle-circle table-hover">
                    <thead>
                    <tr>
                        <th data-toggle="true"> Naam</th>
                        <th> College</th>
                        <th data-hide="all"> Laatste bijwerking</th>
                        <th data-hide="all"></th>
                    </tr>
                    </thead>
                    <div class="form-inline padding-bottom-15">
                        <div class="row">
                            <div class="col-sm-12 text-right m-b-20">
                                <div class="form-group">
                                    <input id="footable-search" type="text" placeholder="Zoeken" class="form-control"
                                           autocomplete="off"></div>
                            </div>
                        </div>
                    </div>
                    <tbody>
                    @if(!empty($teamleaders))
                        @foreach($teamleaders as $teamleader)
                            <tr>
                                <td>{{ $teamleader['teamleader']->name }}</td>
                                <td>{{ $teamleader['college']->name }}</td>
                                <td>{{ date_format($teamleader['teamleader']->updated_at, 'd-m-Y | H:i:s') }}</td>
                                <td>
                                    <a href="{{ URL::route('view_teamleaders', $teamleader['college']->id) }}"
                                       class="college-row-big btn-xs btn-rounded btn-success">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                        Teamleider Bekijken
                                    </a>
                                    <span style="margin-left: 5px;"></span>
                                    <button data-toggle="modal" data-target="#teamleader-little-modal"
                                            id="{{ $teamleader['teamleader']->id }}"
                                            data-name="{{ $teamleader['teamleader']->name }}"
                                            {{-- TODO: data of little change inputs--}}
                                            class="college-row-little btn-xs btn-rounded btn-warning">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                        Bewerken
                                    </button>
                                    <a href="{{ URL::route('change_teamleaders', $teamleader['teamleader']->id) }}"
                                       id="{{ $teamleader['teamleader']->id }}"
                                       class="college-row-big btn-xs btn-rounded btn-danger">
                                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        Grote bewerking
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal for little changes --}}
    <div class="modal fade" id="teamleader-little-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel1">Wijzeging</h4></div>
                <div class="modal-body">
                    <form>
                        <div id="notification-block"></div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Naam:</label>
                            <input type="text" class="form-control" id="modal-name-field">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="save" type="button" class="btn btn-primary">Opslaan</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @include('partials._javascript-alerts')
    <!-- Footable -->
    <script src="{{ URL::asset('plugins/bower_components/footable/js/footable.all.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"
            type="text/javascript"></script>
    <!--FooTable init-->
    <script src="{{ URL::asset('js/footable-init.js') }}"></script>
    @include('partials._javascript-paddingfixer')
@stop