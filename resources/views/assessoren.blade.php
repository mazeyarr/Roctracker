@extends('layouts.app')

@section('title', 'Assessoren')

@section('page-title', 'Assessoren')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
                <table id="college-footable" class="table toggle-circle table-hover">
                    <thead>
                    <tr>
                        <th data-toggle="true"> Naam</th>
                        <th> College(s)</th>
                        <th> Functie</th>
                        <th> Status</th>
                        <th data-hide="all"> Team</th>
                        <th data-hide="all"> Teamleider</th>
                        <th data-hide="all"> Opgeleid door</th>
                        <th data-hide="all"> Gecertificeerd door</th>
                        <th data-hide="all"> Laatste bijwerking</th>
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
                    <tbody>
                    @if(!empty($assessors))
                        @foreach($assessors as $assessor)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="{{ URL::route('view_teamleaders', $assessor->id) }}"
                                       class="college-row-big btn-xs btn-rounded btn-success">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                        Assessor Bekijken
                                    </a>
                                    <span style="margin-left: 5px;"></span>
                                    <button data-toggle="modal" data-target="#teamleader-little-modal"
                                            id="{{ $assessor->id }}"
                                            data-name="{{ $assessor->name }}"
                                            data-team="{{ $assessor->team }}"
                                            class="teamleader-row-little btn-xs btn-rounded btn-warning">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                        Bewerken
                                    </button>
                                    <a href="{{ URL::route('change_teamleaders', $assessor->id) }}"
                                       id="{{ $assessor->id }}"
                                       class="college-row-big btn-xs btn-rounded btn-danger">
                                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        Grote bewerking
                                    </a>
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
    @include('partials._javascript-paddingfixer')
@stop