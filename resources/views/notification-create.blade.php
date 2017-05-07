@extends('layouts.app')

@section('title', 'Berichten Aanmaken')

@section('page-title', 'Berichten Aanmaken')

@section('content')


    <div class="row">
        @foreach($texts as $mail)
            <div class="col-md-12">
                <div id="panel-{{$mail->id}}" class="panel {{ $mail->done ? "panel-success" : "panel-info" }}">
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

                            <div class="form-group m-b-40">
                                <div class="row">
                                    <div class="col-xs-3">
                                        {!! Form::checkbox('repeat', $mail->repeat, $mail->repeat, array('id' => 'repeat-' . $mail->id, 'class' => 'check', 'data-task-id' => $mail->id,'data-checkbox' => 'icheckbox_line-green', 'data-label' => 'Deze mail jaarlijks herhalen ?')) !!}
                                    </div>
                                    <div class="col-xs-offset-9"></div>
                                </div>
                            </div>
                        </form>
                        <!-- .row dropzone -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="white-box">
                                    <form action="{!! URL::route('notification_save_attachment', $mail->id) !!}" id="upload-list-{{$mail->id}}" class="dropzone">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <div class="fallback">
                                            <input name="attachment" type="file" multiple />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3" id="container-attached-files-{{$mail->id}}">
                                @if(!empty($mail->uploaded_files))
                                    @foreach($mail->uploaded_files as $file)
                                        <div class="m-b-10 m-t-10">
                                            <span class="label label-info">{{$file->name}}</span>
                                            <button type="button" id="btnRemoveAttachment-{{$file->id}}" data-task-id="{{$mail->id}}" data-file-id="{{$file->id}}" class="btn btn-danger btn-circle btnRemoveAttachment"><i class="fa fa-times"></i> </button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        @if($mail->done)
                            <div class="row">
                                <div class="col-md-12">
                                    <button id="{{$mail->id}}" class="resetMail btn btn-warning btn-block">Reset Mail</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-sm-12">
            <button id="btnAdd" class="btn btn-success btn-circle btn-xl" style="float: right; padding-top: 15px;"><i class="fa fa-plus"></i></button>
        </div>
    </div>
    @include('partials._components._modals', [
        'id' => 'modal-email-sender-list',
        'modal_title' => 'Email Lijst Aanmaken',
        'btnClose_id' => 'btnModalClose',
        'btnAction_id' => null,
        'btnClose_text' => 'Sluiten',
        'btnAction_text' => null,
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
    <!-- Custom Theme JavaScript -->
    <script src="{!! URL::asset('js/custom.min.js') !!}"></script>
    <!-- Dropzone Plugin JavaScript -->
    <script src="{{URL::asset('plugins/bower_components/custom-select/custom-select.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('js/jquery.quicksearch.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{URL::asset('plugins/bower_components/multiselect/js/jquery.multi-select.js')}}"></script>
    <!-- Dropzone Plugin JavaScript -->
    <script src="{!! URL::asset('plugins/bower_components/dropzone-master/dist/dropzone.js') !!}"></script>
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
                btnAdd = $('#btnAdd'),
                modal = $('#modal-email-sender-list'),
                body = $('body'),
                _inputs = $(':input'),
                _table = $('._table'),
                _multiselect = $('#select-receivers'),
                _ichecks = $('.check'),
                _btnRemoveAttachment = $('.btnRemoveAttachment'),
                _btnResetMail = $('.resetMail');

            @foreach($texts as $task)
                Dropzone.options.uploadList{{$task->id}} = {
                    acceptedFiles: ".doc, .docx, .xls, .xlsx, .pdf, .csv, .txt",
                    paramName: "attachment", // The name that will be used to transfer the file
                    maxFilesize: 2, // MB
                    addRemoveLinks: true,
                    maxFiles: 3,
                    dictInvalidFileType: "Dit is het verkeerde bestands type graag alleen (.doc, .docx, .xls, .xlsx, .pdf, .csv, .txt)",
                    dictFileTooBig: "Dit bestand is te groot graag alleen bestanden van maximaal "+2+" MB",
                    dictRemoveFile: "Bestand verwijderen",
                    dictDefaultMessage: "Plaats of Sleep eventuele bestanden hier",
                    dictMaxFilesExceeded: "Sorry, maar er zijn maar 3 bestanden toegestaan",
                    init: function() {
                        this.on("error", function(file, response) {
                            this.removeFile(file);
                            var message = "";
                            if($.type(response) === "string") {
                                message = response;
                            }
                            else {
                                message = "Er ging iets mis";
                            }
                            $.toast({
                                heading: 'Warning'
                                , text: message
                                , position: 'top-right'
                                , loaderBg: '#fbeb50'
                                , icon: 'warning'
                                , hideAfter: 3500
                                , stack: 6
                            });
                        });
                    },
                    success: function (file, response, xhr) {
                        response = jQuery.parseJSON(response);
                        if(response.error) {
                            $.toast({
                                heading: 'Warning'
                                , text: response.message
                                , position: 'top-right'
                                , loaderBg: '#fbeb50'
                                , icon: 'warning'
                                , hideAfter: 3500
                                , stack: 6
                            });
                            return;
                        }
                        this.removeFile(file);
                        showNewAttachment(response.id, jQuery.parseJSON(response.file));
                        $.toast({
                            heading: response.title
                            , text: response.message
                            , position: 'top-right'
                            , icon: response.status
                            , hideAfter: 3500
                            , stack: 6
                        });
                    }
                };
            @endforeach

            function showNewAttachment(taskId, file) {
                var fileContainer = $('#container-attached-files-' + taskId);
                fileContainer.append('<div class="m-b-10 m-t-10"> <span class="label label-info">'+file.name+'</span> <button type="button" id="btnRemoveAttachment-'+file.id+'" data-task-id="'+taskId+'" data-file-id="'+file.id+'" class="btn btn-danger btn-circle btnRemoveAttachment"><i class="fa fa-times"></i> </button></div>')
                var _attachment = $('#btnRemoveAttachment-' + file.id);
                _attachment.click(function () {
                    removeAttachment(taskId, file.id, _attachment);
                });
            }

            function removeAttachment(taskId, fileId, element) {
                var url = "{{URL::route('notification_remove_attachment', "XreplaceX")}}";
                url = url.replace('XreplaceX', taskId);
                $.post(url,
                    {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: fileId
                    },
                    function( response ) {
                        if(response.error) {
                            ezToast('Mislukt !', response.message, 'danger', 2500, '#ff6371');
                            return;
                        }

                        ezToast('Gelukt !', response.message, 'success', 1500, '#61ff55');
                        var elementContainer = element.closest('div');
                        elementContainer.remove();
                });
            }

            _btnResetMail.click(function (e) {
                e.stopPropagation();
                var url = laroute.route('ajax_reset_mail', { mail_task_id : this.id }),
                    id = this.id;
                $.get(url, function (data) {
                    if (data) {
                        $('#panel-' + id).attr('class', 'panel panel-info');
                        ezToast("Mail Reset", "Deze mail is successvol gereset, vul de nieuwe datum in voor deze mail opdracht", 'info', 3000, '#8a9eff')
                    }else {
                        ezToast("Fout", "Er ging iets mis met het resetten van de mail probeer het later nog een keer", 'warning', 3000, '#ff9d84')
                    }
                });
            });

            _btnRemoveAttachment.click(function () {
                var taskId = $(this).attr('data-task-id'),
                    fileId = $(this).attr('data-file-id');
                removeAttachment(taskId, fileId, $(this))
            });

            btnAdd.click(function (e) {
                e.preventDefault();

                $.post("{!! URL::route('notification_create_new') !!}",
                {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },function (data) {
                    if (data === "true") {
                        ezToast('Aangemaakt !', "De groep was successvol aangemaakt", 'success', 1500, '#61ff55');
                        setTimeout(function () {
                            window.location.reload();
                        }, 1500);
                    } else {
                        ezToast('Fout !', "Er ging iets fout bij het aanmaken van de groep", 'danger', 2500, '#ff6371')
                    }
                });
            });

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

            _ichecks.on('ifChecked', function(event){
                var _checkbox = $('#' + event.currentTarget.id),
                    name = _checkbox.attr('name'),
                    taskId = _checkbox.attr('data-task-id');
                saveMailTaskData(taskId, name, 1, false, "Deze E-mail zal elk jaar herhaald worden.");
            });

            _ichecks.on('ifUnchecked', function(event){
                var _checkbox = $('#' + event.currentTarget.id),
                    name = _checkbox.attr('name'),
                    taskId = _checkbox.attr('data-task-id');
                saveMailTaskData(taskId, name, 0, false, "Deze E-mail zal <strong>niet</strong> herhaald worden.");
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
                            var init = true;
                            _multiselect.multiSelect({
                                keepOrder: true,
                                selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='Zoeken'>",
                                selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='Zoeken'>",
                                afterInit: function(ms){
                                    var that = this,
                                        $selectableSearch = that.$selectableUl.prev(),
                                        $selectionSearch = that.$selectionUl.prev(),
                                        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                                        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

                                    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                                        .on('keydown', function(e){
                                            if (e.which === 40){
                                                that.$selectableUl.focus();
                                                return false;
                                            }
                                        });

                                    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                                        .on('keydown', function(e){
                                            if (e.which === 40){
                                                that.$selectionUl.focus();
                                                return false;
                                            }
                                        });
                                    $.each(receivers.all, function (index, object) {
                                        _multiselect.multiSelect('addOption', {
                                            value: object.id,
                                            text: object.name,
                                            index: index
                                        });
                                    });

                                    $.each(receivers.current, function (index, id) {
                                        _multiselect.multiSelect('select', id.toString())
                                    });

                                    that.qs1.cache();
                                    that.qs2.cache();

                                    init = false;
                                },
                                afterSelect: function(){
                                    console.log(init);
                                    if (init === false) {
                                        saveMailTaskData(taskId, "to", _multiselect.val(), false);
                                    }
                                    this.qs1.cache();
                                    this.qs2.cache();
                                },
                                afterDeselect: function(){
                                    console.log(init);
                                    if (init === false) {
                                        if (_multiselect.val() === null) {
                                            saveMailTaskData(taskId, "to", "none", false, "Er zijn nu geen ontvangers van deze mail");
                                        } else {
                                            saveMailTaskData(taskId, "to", _multiselect.val(), false);
                                        }
                                    }
                                    this.qs1.cache();
                                    this.qs2.cache();
                                }
                            });

                            modal.modal('show');

                            $('#select-all').click(function (e) {
                                e.preventDefault();
                                _multiselect.multiSelect('select_all');
                            })

                            $('#deselect-all').click(function (e) {
                                e.preventDefault();
                                _multiselect.multiSelect('deselect_all');
                            })
                        }
                    },
                    progressType: 'info'
                });

                var receiverGroup = thisBtn.attr('data-table');

                $.get( "{{URL::route('ajax_get_actieve_from_table', null)}}/"+receiverGroup, function( data ) {
                    if (data.hasOwnProperty('status') && !data.status) {
                        ezToast('Wacht..', "" + data.message, "warning", 4000, '#fffd5d');
                        waitingDialog.hide();
                    }else {
                        var all_receivers = data;
                        $.get( "{{URL::route('ajax_get_current_receivers', null)}}/"+taskId, function( currentReceivers ) {
                            if (currentReceivers) {
                                var m_currentReceivers = $.parseJSON(currentReceivers);
                                receivers = {
                                    'all': all_receivers,
                                    'current': m_currentReceivers
                                }
                            } else {
                                receivers = {
                                    'all': all_receivers,
                                    'current': []
                                }
                            }
                            waitingDialog.hide();
                        });
                    }
                });
            });

            btnModalClose.click(function (e) {
                e.stopPropagation();
                e.preventDefault();
                modal.modal('hide');
            });

            modal.on('hidden.bs.modal', function () {
                _multiselect.multiSelect('destroy');
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

            function saveMailTaskData(id, name, value, element, customMessage) {
                if (typeof id === "undefined") return;
                $.post("{!! URL::route('notification_save') !!}",
                {
                    id: id,
                    name: name,
                    value: value,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                function(data){
                    if (element) var input = element.closest('.form-group');
                    if (data === "true") {
                        if (element) {
                            resetInputSuccess(input);
                        }else {
                            if (!customMessage){
                                ezToast('Opgeslagen !', 'Deze persoon is nu een ontvanger van deze mail', 'success', 2000, '#70ff57');
                            } else {
                                ezToast('Opgeslagen !', ''+customMessage, 'success', 2000, '#70ff57');
                            }
                        }
                    }else{
                        if (element) {
                            resetInputError(input);
                        }else {
                            ezToast('Fout !', 'Er is iets misgegaan...', 'danger', 2000, '#ff504e');
                        }
                    }
                });
            }
        });
    </script>
@stop