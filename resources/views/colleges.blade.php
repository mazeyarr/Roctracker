@extends('layouts.app')

@section('title', 'College')

@section('page-title', 'College')

@section('content')
    <!-- /row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <div class="table-responsive">
                    <table id="college" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Locatie</th>
                            <th>Teamleider</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($colleges as $college)
                            <tr class="college-info" data-id="{{ $college->id }}" data-name="{{ $college->name }}" data-location="{{ $college->location }}" data-toggle="modal" data-target="#responsive-modal">
                                <td>{{ $college->name }}</td>
                                <td>{{ $college->location }}</td>
                                @if($college->teamleader_id != '')
                                    <td class="leader-name"> {{ \App\Teamleaders::find($college->teamleader_id)->name }} </td>
                                @else
                                    <td></td>
                                @endif
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
            <a href="{{ URL::route('add_college') }}" type="button" class="btn btn-success btn-circle btn-xl" style="float: right; padding-top: 20px;"><i class="fa fa-plus"></i> </a>
        </div>
    </div>

    <!-- /.modal -->
    <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">College aanpassen</h4> </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Recipient:</label>
                            {!! Form::text('name', null, ['id' => 'enter-name', 'class' => 'form-control','required' => '', 'placeholder' => 'College naam']) !!} </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Message:</label>
                            {!! Form::text('location', null, ['id' => 'enter-location', 'class' => 'form-control', 'required' => '', 'placeholder' => 'Keizerin marialaan 2']) !!}
                        </div>
                        <div class="form-group">
                            {{-- {!! Form::email('teamleader', null, ['class' => 'form-control', 'required' => '', 'placeholder' => '']) !!}--}}
                            <select class="form-control select-teamleader" name="teamleader" id="choose-teamleader">
                                <option value="default" id="default-name">Kies een Teamleider</option>
                                @foreach($teamleaders as $teamleader)
                                    <option value="{{ $teamleader->id }}">{{ $teamleader->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="close" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button id="save-changes" type="button" class="btn btn-danger waves-effect waves-light">Save changes</button>
                </div>
            </div>
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
    {!! Html::script('plugins/bower_components/custom-select/custom-select.min.js') !!}
    {!! Html::script('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') !!}
    <!-- end - This is for export functionality only -->
    <script>
        $(document).ready(function () {
            var ready = false;
            var college_id;
            var college_name;
            var college_location;
            var college_leader;
            $('#college').DataTable();
            $('#close').click(function () {
                $('body').css('padding-right', '0px')
            })
            $('#save-changes').click(function (e) {
                e.preventDefault()
                e.stopPropagation()
                $(this).prop('disabled', true)
                $('body').css('padding-right', '0px')
                college_name = $('#enter-name').val()
                college_location = $('#enter-location').val()
                college_leader = $( "#choose-teamleader" ).val();
                if (ready) {
                    $.getJSON('/dashboard/college/change/' + college_id + '/' + college_name + '/' + college_location + '/' + college_leader,
                    {},
                    function (data) {
                        $('#save-changes').prop('disabled', false)
                        switch (data.status) {
                            case 'success':
                                $.toast({
                                    heading: 'Success'
                                    , text: data.message
                                    , position: 'top-right'
                                    , loaderBg: '#00C292'
                                    , icon: 'success'
                                    , hideAfter: 1500
                                    , stack: 6
                                })
                                setTimeout(
                                function()
                                {
                                    location.reload();
                                }, 1000 );
                                break
                            case 'error':
                                $.toast({
                                    heading: 'Error'
                                    , text: data.message
                                    , position: 'top-right'
                                    , loaderBg: '#ff6849'
                                    , icon: 'error'
                                    , hideAfter: 3500
                                    , stack: 6
                                })
                                break
                        }
                    });
                }
            })
            $('.college-info').click(function () {
                ready = false
                college_id = ''
                college_name = ''
                college_location = ''
                college_leader = ''

                college_id = $(this).attr('data-id')
                college_name = $(this).attr('data-name')
                college_location = $(this).attr('data-location')
                college_leader = $(this).find('.leader-name').html()

                $('#enter-name').val('')
                $('#enter-location').val('')

                $('#enter-name').val(college_name)
                $('#enter-location').val(college_location)
                $('#default-name').html(college_leader)

                ready = true
            })
        });
    </script>
@stop