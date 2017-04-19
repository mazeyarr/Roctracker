@extends('layouts.app')

@section('title', 'Berichten Aanmaken')

@section('page-title', 'Berichten Aanmaken')

@section('content')
    <div class="row">
        @foreach($texts as $mail)
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading"> {{$mail->fk_mail_texts->name}}
                    </div>
                    <div class="panel-body">
                        <form class="floating-labels form-mailtext" data-toggle="validator" id="form-mailtext-{{$mail->fk_mail_texts->id}}">
                            <div class="form-group m-b-40 m-t-20" data-task-id="{{$mail->id}}">
                                {!! Form::text('name', $mail->fk_mail_texts->name, array('id' => 'name-'.$mail->fk_mail_texts->id , 'class' => '_name form-control', 'required' => '')) !!}
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="name-{{$mail->fk_mail_texts->id}}">Naam van deze tekst</label>
                            </div>

                            <div class="form-group m-b-40 m-t-20" data-task-id="{{$mail->id}}">
                                {!! Form::text('title', $mail->fk_mail_texts->title, array('id' => 'title-'.$mail->fk_mail_texts->id , 'class' => '_title form-control', 'required' => '')) !!}
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="title-{{$mail->fk_mail_texts->id}}">Titel van deze E-Mail</label>
                            </div>

                            <div class="form-group m-b-40 m-t-20" data-task-id="{{$mail->id}}">
                                {!! Form::text('subject', $mail->fk_mail_texts->subject, array('id' => 'subject-'.$mail->fk_mail_texts->id , 'class' => '_subject form-control', 'required' => '')) !!}
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="subject-{{$mail->fk_mail_texts->id}}">Onderwerp van deze E-Mail</label>
                            </div>

                            <div class="form-group m-b-40 m-t-20" data-task-id="{{$mail->id}}">
                                {!! Form::textarea('text', $mail->fk_mail_texts->text, array('id' => 'text-'.$mail->fk_mail_texts->id , 'class' => '_text form-control', 'required' => '')) !!}
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="text-{{$mail->fk_mail_texts->id}}">Bericht van deze E-Mail @include('partials._components._icon-tooltip',array('fa' => 'fa-info-circle', 'text' => "(optioneel) u kunt ook html hier gebruiken bij uw bericht" )) </label>
                            </div>

                            <div class="form-group m-b-40 m-t-20" data-task-id="{{$mail->id}}">
                                {!! Form::select('type', $types, $mail->fk_mail_texts->type, array('id' => 'type-'.$mail->fk_mail_texts->id , 'class' => '_type form-control', 'required' => '', 'style' => 'padding: 0px;')) !!}
                                <label for="type-{{$mail->fk_mail_texts->id}}">Wat voor type mail is dit</label>
                            </div>

                            <hr>
                            <h2>Planning</h2>
                            <hr>

                            <div class="form-group m-b-40 m-t-40" data-task-id="{{$mail->id}}">
                                {!! Form::text('at_date', $mail->at_date, array('id' => 'at_date-'.$mail->id , 'class' => '_at_date form-control', 'required' => '')) !!}
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="at_date-{{$mail->id}}">Verstuur Datum <small>(dd-mm-yyyy hh:mm)</small></label>
                            </div>
                            <div class="form-group m-t-20" data-task-id="{{$mail->id}}">
                                {!! Form::select('table', array('teamleaders' => "Teamleiders", 'assessors' => "Assessoren"), $mail->table, array('id' => 'table-'.$mail->id , 'class' => '_table form-control', 'required' => '', 'style' => 'padding: 0px;')) !!}
                                <label for="to-{{$mail->id}}">Naar wie word deze email verstuurd ?</label>
                            </div>
                            <div class="form-group m-b-40">
                                {!! Form::button('Email lijst maken/aanpassen', array('id' => 'btnMakeList-' . $mail->id, 'class' => 'btnMakeList btn btn-success', 'data-table' => empty($mail->table) ? '' : $mail->table, 'data-id' => $mail->id)) !!}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- /.row -->
    @include('partials._components._modals', [
        'id' => 'modal-email-sender-list',
        'modal_title' => 'Email Lijst Aanmaken',
        'btnClose_id' => 'btnModalClose',
        'btnAction_id' => 'btnModalAction',
        'btnClose_text' => 'Sluiten',
        'btnAction_text' => 'Opslaan',
        'inputs' => null,
        'select' => array(
            'id' => 'select-receivers',
            'options' => 'multiple',
            'name' => 'receivers-of-mail'
        )
    ])
@stop

@section('scripts')
    @include('partials._javascript-paddingfixer')
    @include('partials._javascript-alerts')
    <script src="{{URL::asset('plugins/bower_components/custom-select/custom-select.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{URL::asset('plugins/bower_components/multiselect/js/jquery.multi-select.js')}}"></script>
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
    <script type="text/javascript">
        $(document).ready(function (e) {
            var btnMakeList = $('.btnMakeList'),
                btnModalClose = $('#btnModalClose'),
                btnModalAction = $('#btnModalAction'),
                modal = $('#modal-email-sender-list'),
                body = $('body'),
                _inputs = $(':input'),
                _table = $('._table'),
                _multiselect = $('#select-receivers');

            _inputs.blur(function (e) {
                if ($(this).is( ":text" )) {
                    if ($(this).val() === "") {
                       return resetInputError($(this).closest('.form-group'));
                    }
                }
            });

            _inputs.keyup(function (e) {
                if ($(this).val() === "") {
                    return resetInputError($(this).closest('.form-group'));
                }
                var taskId = $(this).closest('.form-group').attr('data-task-id');
                saveMailTaskData(taskId, this.name, $(this).val(), $(this));
            });

            _inputs.change(function () {
                if ($(this).is( "select" )) {
                    var taskId = $(this).closest('.form-group').attr('data-task-id');
                    saveMailTaskData(taskId, this.name, $(this).val(), $(this));
                    if ($(this).attr('name') === "table"){
                        $('#btnMakeList-' + taskId).attr('data-table', $(this).val());
                    }
                }
            });

            body.on('click', btnMakeList, function (event) {
                var btnId = event.target.id,
                    thisBtn = $('#' + btnId),
                    taskId = thisBtn.attr('data-id'),
                    receivers = false;

                if (!thisBtn.hasClass('btnMakeList')) {
                    return;
                }

                if (thisBtn.attr('data-table') === "") {
                    ezToast('Wacht..', "U heeft nog niet groep geselecteerd naar wie u deze mail wilt stuuren.", "warning", 3500, '#fffd5d');
                    return;
                }

                waitingDialog.show('Moment Geduld...',{
                    onHide: function () {
                        if (receivers !== false) {
                            $.each(receivers, function (index, object) {
                                _multiselect.multiSelect('addOption', {
                                    value: object.id,
                                    text: object.name,
                                    index: index
                                });
                            });
                            _multiselect.multiSelect();
                            modal.modal('show');
                        }
                    },
                    progressType: 'info'
                });

                var receiverGroup = thisBtn.attr('data-table');

                $.get( "{{URL::route('ajax_get_actieve_from_table', null)}}/"+receiverGroup, function( data ) {
                    if (data.hasOwnProperty('status') && !data.status) {
                        ezToast('Wacht..', "" + data.message, "warning", 4000, '#fffd5d');
                    }else {
                        receivers = data;
                    }
                    waitingDialog.hide();
                });
            });

            btnModalClose.click(function (e) {
                e.stopPropagation();
                e.preventDefault();
                _multiselect.multiSelect('deselect_all');
                modal.modal('hide');
            });

            btnModalAction.click(function (e) {
                // TODO : SAVE RECEIVERS http://stackoverflow.com/questions/25750253/bootstrap-multiselectrefresh-is-not-working-properly
            });

            function resetInputError(element) {
                element.removeClass('has-error');
                element.removeClass('has-success');
                element.removeClass('has-feedback');
                element.addClass('has-error');
                element.addClass('has-feedback');
            }
            function resetInputSuccess(element) {
                element.removeClass('has-error');
                element.removeClass('has-success');
                element.removeClass('has-feedback');
                element.addClass('has-success');
                element.addClass('has-feedback');
            }

            function saveMailTaskData(id, name, value, element) {
                $.post("{!! URL::route('notification_save') !!}",
                {
                    id: id,
                    name: name,
                    value: value,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                function(data){
                    var input = element.closest('.form-group');
                    if (data === "true") {
                        resetInputSuccess(input);
                    }else{
                        resetInputError(input);
                    }
                });
            }
        });
    </script>
@stop