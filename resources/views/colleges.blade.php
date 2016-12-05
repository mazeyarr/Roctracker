@extends('layouts.app')

@section('title', 'Colleges')

@section('page-title', 'Colleges')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
                <table id="college-footable" class="table toggle-circle table-hover">
                    <thead>
                    <tr>
                        <th data-toggle="true"> College Naam </th>
                        <th> Locatie </th>
                        <th> Actieve Assessoren </th>
                        <th data-hide="all"> DOB </th>
                        <th data-hide="all"> Status </th>
                    </tr>
                    </thead>
                    <div class="form-inline padding-bottom-15">
                        <div class="row">
                            <div class="col-sm-12 text-right m-b-20">
                                <div class="form-group">
                                    <input id="footable-search" type="text" placeholder="Zoeken" class="form-control" autocomplete="off"> </div>
                            </div>
                        </div>
                    </div>
                    <tbody>
                    <tr>
                        <td>Isidra</td>
                        <td>Boudreaux1</td>
                        <td>Traffic Court Referee</td>
                        <td>22 Jun 1972</td>
                        <td><span class="label label-table label-success">Active</span></td>
                    </tr>
                    <tr>
                        <td>Isidrsdsadsdsasa</td>
                        <td>Boudreaux2</td>
                        <td>Traffic Court Referee</td>
                        <td>22 Jun 1972</td>
                        <td><span class="label label-table label-success">Active</span></td>
                    </tr>
                    <tr>
                        <td>Isiaasdfghgjfhdra</td>
                        <td>Boudreaux3</td>
                        <td>Traffic Court Referee</td>
                        <td>22 Jun 1972</td>
                        <td><span class="label label-table label-success">Active</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <!-- Footable -->
    <script src="{{ URL::asset('plugins/bower_components/footable/js/footable.all.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
    <!--FooTable init-->
    <script src="{{ URL::asset('js/footable-init.js') }}"></script>
@stop