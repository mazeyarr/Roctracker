@extends('layouts.app')

@section('title', 'Berichten Overzicht')

@section('page-title', 'Berichten Overzicht')

@section('content')

    <!-- row -->
    <div class="row">
        <!-- Left sidebar -->
        <div class="col-md-12">
            <div class="white-box">
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mail_listing">
                        <div class="inbox-center">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th colspan="4">
                                        <div class="btn-group">
                                            <button id="btnRefresh" type="button" class="btn btn-default waves-effect waves-light  dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-refresh"></i> </button>
                                        </div>
                                    </th>
                                    <th class="hidden-xs" width="100">
                                        <div class="btn-group pull-right">
                                        </div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($emails as $email)
                                    <tr class="unread">
                                        <td>
                                            <div class="checkbox m-t-0 m-b-0">
                                                <input type="checkbox" class="select_mail" id="{{$email->id}}">
                                                <label for="checkbox0"></label>
                                            </div>
                                        </td>
                                        <td class="hidden-xs"><i class="fa fa-star-o"></i></td>
                                        <td class="hidden-xs">{{$email->to}}</td>
                                        <td class="max-texts"> <a href="{{URL::route('notification_view', $email->id)}}"> {{ strlen($email->text) > 50 ? substr(strip_tags($email->text),0,50)."..." : strip_tags($email->text) }} </a></td>
                                        </td>
                                        @if($email->send)
                                            <td class="hidden-xs"><span class="label label-success m-r-10" id="email-status-{{$email->id}}">Verzonden</span></td>
                                        @else
                                            <td class="hidden-xs"><span class="label label-danger m-r-10" id="email-status-{{$email->id}}">Niet Verzonden</span></td>
                                        @endif
                                            <td class="text-right"> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $email->updated_at)->format('d-M-y') }} </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 m-t-20">
                                <button id="resend_mails" class="btn btn-info" style="display: none;"> Geselecteerde mails opnieuw stuuren <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7 m-t-20"> Word weergegeven  {{($emails->perPage() * $emails->currentPage()) - $emails->perPage() }} tot {{$emails->perPage() * $emails->currentPage()}} || van {{$emails->total()}} || Verstuurde E-mails</div>
                            <div class="col-xs-5 m-t-20">
                                <div class="btn-group pull-right">
                                    {!! $emails->render() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div>
    </div>
    <!-- /.row -->

@stop

@section('scripts')
    @include('partials._javascript-alerts')

    <script type="text/javascript">
        $(document).ready(function () {
            var select_boxes = $('.select_mail'),
                btnResend = $('#resend_mails'),
                btnRefresh = $('#btnRefresh'),
                selected_emails = [];

            btnRefresh.click(function (e) {
                window.location.reload();
            });

            $('body').on('change', select_boxes, function (event) {
                var id = event.target.id,
                    checkbox = $('#' + id);

                if (checkbox.is(':checkbox')) {

                    if (checkbox.prop('checked')) {
                        selected_emails.push(id);
                    } else {
                        var index = selected_emails.indexOf(id);
                        selected_emails.splice(index, 1);
                    }

                    if (selected_emails.length <= 0) {
                        if (btnResend.is(":visible")) {
                            btnResend.hide(500);
                        }
                    } else {
                        if (btnResend.is(":hidden")) {
                            btnResend.show(500);
                        }
                    }

                }
            });

            btnResend.click(function (e) {
                e.preventDefault();
                e.stopPropagation();

                /* TODO: MAKE THIS FUNCTION REUSEABKLE */

                swal({
                    title: "Emails opnieuw verstuuren",
                    text: "U dient uw wachtwoord intevoeren voordat de emails opnieuw verzonden kunnen worden",
                    type: "input",
                    inputType: "password",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    cancelButtonText: "Annuleren",
                    confirmButtonText: "Bevestigen",
                    animation: "slide-from-top",
                    inputPlaceholder: "Uw Wachtwoord"
                },
                function (inputValue) {
                    swalShowLoad(true);
                    if (inputValue === "") {
                        swal.showInputError("U dient een wachtwoord intevoeren");
                        swalShowLoad(false);
                    } else if (!inputValue) {
                        ezToast('Attentie !', "Opnieuw Verzenden Geannuleerd", 'warning', 2000, "#FEC107");
                        swalShowLoad(false);
                    } else {
                        swalShowLoad(true);
                        $.getJSON('{!! URL::route('ajax_check_user_password',null) !!}/' + inputValue, function (response) {
                            if (response) {
                                $.post("{{ URL::route('ajax_post_resend_mails') }}", {_token: $('meta[name="csrf-token"]').attr('content'), emails: selected_emails}, function(result){
                                    console.log(result);
                                    swalShowLoad(false);
                                    $.each(result.failed, function (key, id) {
                                        var element = $('#email-status-' + id);
                                        element.attr('class', 'label label-danger m-r-10');
                                        element.html('Niet Verzonden');
                                    });

                                    $.each(result.sended, function (key, id) {
                                        var element = $('#email-status-' + id);
                                        element.attr('class', 'label label-success m-r-10');
                                        element.html('Verzonden');
                                    });
                                    ezToast("Info", "Emails geselecteerde emails worden opnieuw verzonden", 'info', 2000, '#4c53ff')
                                    swal.close();
                                });
                            } else {
                                swalShowLoad(false);
                                swal.showInputError("Wachtwoord was incorrect...");
                            }
                        });
                    }
                });
            });
        });
    </script>
@stop