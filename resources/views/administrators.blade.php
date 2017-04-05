@extends('layouts.app')

@section('title', 'Administratoren')

@section('page-title', 'Administratoren')

@section('content')
    <!-- /row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <div class="table-responsive">
                    <table id="admins" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Email</th>
                            <th>Gebruiker sinds</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ date("d/m/Y", strtotime($user->created_at) ) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <a href="{{ URL::route('add_users') }}" type="button" class="btn btn-success btn-circle btn-xl"
               style="float: right; padding-top: 20px;"><i class="fa fa-plus"></i> </a>
        </div>
    </div>
@stop

@section('scripts')
    {!! Html::script('plugins/bower_components/datatables/jquery.dataTables.min.js') !!}
    <!-- start - This is for export functionality only -->
    {!! Html::script('datatable/buttons/1.2.2/js/dataTables.buttons.min.js') !!}
    {!! Html::script('datatable/buttons/1.2.2/js/buttons.flash.min.js') !!}
    {!! Html::script('datatable/ajax/libs/jszip/2.5.0/jszip.min.js') !!}
    {!! Html::script('datatable/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js') !!}
    {!! Html::script('datatable/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js') !!}
    {!! Html::script('datatable/buttons/1.2.2/js/buttons.html5.min.js') !!}
    {!! Html::script('datatable/buttons/1.2.2/js/buttons.print.min.js') !!}
    <!-- end - This is for export functionality only -->
    <script>
        $(document).ready(function () {
            $('#admins').DataTable();
        });
    </script>
@stop