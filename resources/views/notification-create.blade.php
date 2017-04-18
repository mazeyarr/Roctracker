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
                            <div class="form-group m-b-40 m-t-20">
                                {!! Form::text('name-' . $mail->fk_mail_texts->id, $mail->fk_mail_texts->name, array('id' => 'name-'.$mail->fk_mail_texts->id , 'class' => '_name form-control', 'required' => '')) !!}
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="id-name-{{$mail->fk_mail_texts->id}}">Naam van deze tekst</label>
                            </div>

                            <div class="form-group m-b-40 m-t-20">
                                {!! Form::text('title-' . $mail->fk_mail_texts->id, $mail->fk_mail_texts->title, array('id' => 'title-'.$mail->fk_mail_texts->id , 'class' => '_title form-control', 'required' => '')) !!}
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="id-title-{{$mail->fk_mail_texts->id}}">Titel van deze E-Mail</label>
                            </div>

                            <div class="form-group m-b-40 m-t-20">
                                {!! Form::text('subject-' . $mail->fk_mail_texts->id, $mail->fk_mail_texts->subject, array('id' => 'subject-'.$mail->fk_mail_texts->id , 'class' => '_subject form-control', 'required' => '')) !!}
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="id-subject-{{$mail->fk_mail_texts->id}}">Onderwerp van deze E-Mail</label>
                            </div>

                            <div class="form-group m-b-40 m-t-20">
                                {!! Form::textarea('text-' . $mail->fk_mail_texts->id, $mail->fk_mail_texts->text, array('id' => 'text-'.$mail->fk_mail_texts->id , 'class' => '_text form-control', 'required' => '')) !!}
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="id-text-{{$mail->fk_mail_texts->id}}">Bericht van deze E-Mail @include('partials._components._icon-tooltip',array('fa' => 'fa-info-circle', 'text' => "(optioneel) u kunt ook html hier gebruiken bij uw bericht" )) </label>
                            </div>

                            <div class="form-group m-b-40 m-t-20">
                                {!! Form::select('type-' . $mail->fk_mail_texts->id, $types, null, array('id' => 'type-'.$mail->fk_mail_texts->id , 'class' => '_type form-control', 'required' => '', 'style' => 'padding: 0px;')) !!}
                                <label for="id-type-{{$mail->fk_mail_texts->id}}">Wat voor type mail is dit</label>
                            </div>

                            <h2>Planning</h2>
                            <hr>
                            <div class="form-group m-b-40 m-t-40">
                                {!! Form::text('at_date-' . $mail->id, $mail->at_date, array('id' => 'at_date-'.$mail->id , 'class' => '_at_date form-control', 'required' => '')) !!}
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="id-at_date-{{$mail->id}}">Verstuur Datum <small>(dd-mm-yyyy)</small></label>
                            </div>
                            <div class="form-group m-t-20">
                                {!! Form::select('table-' . $mail->id, array('teamleaders' => "Teamleiders", 'assessors' => "Assessoren"), $mail->table, array('id' => 'table-'.$mail->id , 'class' => '_table form-control', 'required' => '', 'style' => 'padding: 0px;')) !!}
                                <label for="id-to-{{$mail->id}}">Naar wie word deze email verstuurd ?</label>
                            </div>
                            <div class="form-group m-b-40">
                                {!! Form::button('Email lijst maken', array('id' => 'btnMakeList-' . $mail->id, 'class' => 'btnMakeList btn btn-success', 'data-id' => $mail->id)) !!}
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
    <script src="{{URL::asset('plugins/bower_components/custom-select/custom-select.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{URL::asset('plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')}}" type="text/javascript"></script>
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
            $('#public-methods').multiSelect();
            var _name = $('._name'),
                _title = $('._title'),
                _subject = $('._subject'),
                _text = $('._text'),
                _type = $('._type'),
                _at_date = $('._at_date'),
                btnMakeList = $('.btnMakeList'),
                body = $('body');

            _name.keyup(function () {
                var taskId = this.id;
                taskId = taskId.replace('name-', '');
                if ($(this).val() === "") {
                    var input = $(this).closest('.form-group');
                    resetInputError(input);
                    return;
                }
                saveMailTaskData(taskId, 'name', $(this).val(), $(this));
            });
            _title.keyup(function () {
                var taskId = this.id;
                taskId = taskId.replace('title-', '');
                if ($(this).val() === "") {
                    var input = $(this).closest('.form-group');
                    resetInputError(input);
                    return;
                }
                saveMailTaskData(taskId, 'title', $(this).val(), $(this));
            });
            _subject.keyup(function () {
                var taskId = this.id;
                taskId = taskId.replace('subject-', '');
                if ($(this).val() === "") {
                    var input = $(this).closest('.form-group');
                    resetInputError(input);
                    return;
                }
                saveMailTaskData(taskId, 'subject', $(this).val(), $(this));
            });
            _text.keyup(function () {
                var taskId = this.id;
                taskId = taskId.replace('text-', '');
                if ($(this).val() === "") {
                    var input = $(this).closest('.form-group');
                    resetInputError(input);
                    return;
                }
                saveMailTaskData(taskId, 'text', $(this).val(), $(this));
            });

            _at_date.keyup(function () {
                var taskId = this.id;
                taskId = taskId.replace('at_date-', '');
                if ($(this).val() === "") {
                    var input = $(this).closest('.form-group');
                    resetInputError(input);
                    return;
                }
                saveMailTaskData(taskId, 'at_date', $(this).val(), $(this));
            });

            // TODO: Type is an select box

            // TODO: Table is an select box

            body.on('click', btnMakeList, function (event) {
                var btnId = event.target.id,
                    thisBtn = $('#' + btnId),
                    taskId = thisBtn.attr('data-id');
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