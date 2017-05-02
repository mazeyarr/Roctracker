@extends('layouts.app')

@section('title', 'Constructeurs')

@section('page-title', 'Constucteurs')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <a href="{{ URL::route('add_constructors') }}" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Constucteurs toevoegen </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
                <table id="college-footable" class="table toggle-circle table-hover">
                    <thead>
                    <tr>
                        <th data-toggle="true"> Naam</th>
                        <th> College(s)</th>
                        <th> Status </th>
                        <th> Email </th>
                        <th data-hide="all"> Team </th>
                        <th data-hide="all"> Teamleider </th>
                        <th data-hide="all"> Laatste bijwerking </th>
                        <th data-hide="all"></th>
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
                    @foreach($contructors as $contructor)
                        <tr{!!  $contructor->status == 0 ? ' class="assessor-invisable" ' : "" !!}>
                            <td>{{ $contructor->name }}</td>
                            <td>{{ !empty($contructor->fk_college) ? $contructor->fk_college->name : "Geen" }}</td>
                            <td class="assessor-status" data-status="{{ $contructor->status }}">
                                @if ($contructor->status == 0)
                                    <span class="label label-table label-default">Non actief</span>
                                @elseif ($contructor->status == 1)
                                    <span class="label label-table label-success">Actief</span>
                                @elseif ($contructor->status == 2)
                                    <span class="label label-table label-warning">Anders</span>
                                @endif
                            </td>
                            <td>{{ $contructor->email }}</td>
                            <td>{{ $contructor->team }}</td>
                            <td>{{ $contructor->fk_teamleader->name }}</td>
                            <td>{{ date_format($contructor->updated_at, 'd-m-Y | H:i:s') }}</td>
                            <td>
                                <a href="{{ URL::route('view_assessor_profiel', $contructor->id) }}"
                                   class="college-row-big btn-xs btn-rounded btn-primary">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    Assessor Profiel
                                </a>
                                <span style="margin-left: 5px;"></span>
                                <a href="{{ URL::route('view_assessor', $contructor->id) }}"
                                   class="college-row-big btn-xs btn-rounded btn-success">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    Assessor Geschiedenis
                                </a>
                                <span style="margin-left: 5px;"></span>
                                <a href="{{ URL::route('change_assessor', $contructor->id) }}"
                                   id="{{ $contructor->id }}"
                                   class="college-row-big btn-xs btn-rounded btn-danger">
                                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                    Grote bewerking
                                </a>
                            </td>
                        </tr>
                    @endforeach
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
    @include('partials._javascript-paddingfixer')
@stop