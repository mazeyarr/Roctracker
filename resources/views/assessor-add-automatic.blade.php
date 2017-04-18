@extends('layouts.app')

@section('title', 'Assessoren Automatisch Toevoegen')

@section('page-title', 'Assessoren Automatisch Toevoegen')

@section('content')

    <!-- .row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <p class="text-muted m-b-30 font-13"> Doormiddel van deze uitleg kunt uw foutloos een excel lijst uploaden...</p>
                <div id="el_wizard" class="wizard">
                    <ul class="wizard-steps" role="tablist">
                        <li class="active" role="tab" id="wizard_inleiding">
                            <h4><span>1</span>Inleiding</h4>
                        </li>
                        <li role="tab" id="wizard_uitleg">
                            <h4><span>2</span>Uitleg</h4>
                        </li>
                        <li role="tab" id="wizard_import">
                            <h4><span>3</span>Importeren</h4>
                        </li>
                    </ul>
                    <div class="wizard-content">
                        <div class="wizard-pane active" role="tabpanel">
                            <p>
                                Welkom bij het automatisch importeren van assessoren. Voordat u kunt importeren zal u,
                                uw lijst moeten aanpassen zodat het systeem de lijst kan lezen.
                            </p>
                            <p>
                                Als dit foutloos gedaan word zullen alle assessoren in de lijst worden toegevoegd in het systeem.
                            </p>
                            <p>
                                In de volgende stap zal worden uitgelegd om foutloos een lijst te importeren.
                            </p>
                            <p class="text-warning">
                                LET OP: Wanneer verkeerde data word meegegeven in de lijst zullen deze niet worden opgeslagen.
                                De rest zal wel in het systeem komen.
                            </p>
                        </div>
                        <div class="wizard-pane" role="tabpanel">
                            <p>
                                Niet alle lijsten kunnen geimporteert worden, Het is geadviseerd om de "Assessoren Lijst Layout.xlsx" te gebruiken.
                                Deze Lijst kan met de knop hieronder gedownload worden. <br>
                            </p>
                            <button class="btn btn-success btn-rounded waves waves-effect" id="downloadExcel">Download</button>
                            <br><br><br>

                            <h4> Gebruikers Handleiding </h4>
                            <hr>
                            <p>
                                Wanneer u de Layout heeft gedownload kunt u alle tabelen invullen <br>
                                Hieronder is te zien welke regels er gelden bij het invullen van de tabel.
                            </p>
                            <p class="text-warning">LET OP: Kolommen met een ( <span class="text-danger">*</span> ) zijn verplicht</p>
                            <p class="text-warning">
                                LET OP: <b>Als</b> u een andere lijst gebruikt is het verplicht dat deze voldoet aan de volgende eisen
                                <ul style="display: none;" class="tabHideShow">
                                    <li>De Eerste rij zal <b>! exact !</b> dezelfde kolommen namen bevaten als de <a href="{!! URL::route('download_excel_assessor_layout') !!}">"Assessor Layout Template"</a></li>
                                    <li>Alle verplichte kolommen moeten worden ingevuld met de regels die in de onderstaande tabel te zien zijn</li>
                                    <li>Alleen lijsten met de extensie <i>".xls" of ".xlsx"</i> worden toegestaan</li>
                                </ul>
                            </p>
                            <hr>
                            <div class="row" id="table-uitleg" style="display: none;">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Naam <span class="text-danger">*</span></th>
                                                <th>Naam College</th>
                                                <th>Team</th>
                                                <th>Geboorte Datum *</th>
                                                <th>Functie <span class="text-danger">*</span></th>
                                                <th>Training verzorgd door</th>
                                                <th>Diploma uitgegeven door</th>
                                                <th>Beroepskerntaak <span class="text-danger">*</span></th>
                                                <th>Status <span class="text-danger">*</span></th>
                                                <th>Basistraining behaald</th>
                                                <th>Laatste basistrainings datum</th>
                                                <th>Email</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>De volledige naam</td>
                                                <td>1 Naam</td>
                                                <td>Naam van het team</td>
                                                <td><span class="text-warning">yyyy-mm-dd</span></td>
                                                <td>Functie van de assessor</td>
                                                <td>Naam van de instelling waar de training is gevolgd</td>
                                                <td>Naam van de instelling waar de assessor is gecertificeerd</td>
                                                <td>Naam van 1 Teamleider</td>
                                                <td>
                                                    <ul>
                                                        <li>"Actief"</li>
                                                        <li>"Non-actief"</li>
                                                        <li>"Anders"</li>
                                                    </ul></td>
                                                <td>"Ja" / "Nee"</td>
                                                <td>Als <span class="text-warning">Ja</span> bij basistraining is ingevuld. <span class="text-warning">yyyy-mm-dd</span></td>
                                                <td>E-mail adres van deze assessor</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="wizard-pane" role="tabpanel">
                            <!-- .row dropzone -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="white-box">
                                        <p class="text-muted m-b-30"> Sleep of plaats uw excel lijst hieronder</p>
                                        <form action="{!! URL::route('add_assessor_automatic_save') !!}" id="upload-list" class="dropzone">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="fallback">
                                                <input name="file" type="file" multiple />
                                            </div>
                                        </form>
                                    </div>
                                    <button id="undo" data-import="" class="btn btn-danger" style="display: none;"><i class="fa fa-refresh" aria-hidden="true"></i> Laatste upload ongedaan maken</button>
                                    <button id="done" data-import="" class="btn btn-success" style="display: none; float: right;"> Naar de assessoren </button>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <!-- .row rejects-->
    <div class="row" id="rejectContainer" style="display: none;">
        <div class="col-sm-12">
            <div class="white-box">
                <p class="text-muted m-b-10 font-13"> De volgende assessoren uit uw lijst konden niet worden toegevoegd worden</p>
                <p class="text-muted m-b-30 font-13"> Loop vooral nog even na of de velden met een -> <span class="text-danger">*</span></p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box" id="rejects"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

@stop

@section('scripts')
    @include('partials._javascript-alerts')
    @include('partials._javascript-paddingfixer')
    <!-- Form Wizard JavaScript -->
    <script src="{!! URL::asset('plugins/bower_components/jquery-wizard-master/dist/jquery-wizard.min.js') !!}"></script>
    <!-- FormValidation -->
    <link rel="stylesheet" href="{!! URL::asset('plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.css') !!}">
    <!-- FormValidation plugin and the class supports validating Bootstrap form -->
    <script src="{!! URL::asset('plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.js') !!}"></script>
    <script src="{!! URL::asset('plugins/bower_components/jquery-wizard-master/libs/formvalidation/bootstrap.min.js') !!}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{!! URL::asset('js/custom.min.js') !!}"></script>
    <!-- Dropzone Plugin JavaScript -->
    <script src="{!! URL::asset('plugins/bower_components/dropzone-master/dist/dropzone.js') !!}"></script>

    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });
        });

        $(document).ready(function () {
            var el_wizard = $('#el_wizard'),
                btnDownload = $('#downloadExcel'),
                btnUndo = $('#undo'),
                btnFinishPage = $('#done'),
                tabInleiding = $('#wizard_inleiding'),
                tabUitleg = $('#wizard_uitleg'),
                tabImport = $('#wizard_import'),
                tabHideShow = $('.tabHideShow'),
                table_uitleg = $('#table-uitleg'),
                paddingFix = $('.wizard-content'),
                rejectContainer = $('#rejectContainer'),
                el_rejects = $('#rejects'),
                maxFileSize = 2,
                ob_dropzone;

            var el_dropzone = Dropzone.options.uploadList = {
                autoProcessQueue: false,
                acceptedFiles: ".csv, .xlsx, .xls",
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: maxFileSize, // MB
                addRemoveLinks: true,
                maxFiles: 1,
                dictInvalidFileType: "Dit is het verkeerde bestands type graag alleen (.csv, .xls, .xlsx)",
                dictFileTooBig: "Dits bestand is te groot graag alleen bestanden van "+maxFileSize+" MB",
                dictRemoveFile: "Bestand verwijderen",
                dictDefaultMessage: "Sleep of plaats uw excel lijst hier",
                init: function() {
                    ob_dropzone = this;
                    this.on("error", function(file, response) {
                        this.removeFile(file);
                        var message = "";
                        if($.type(response) === "string") {
                            message = response;
                        }
                        else {
                            message = "er ging iets mis";
                        }
                        $.toast({
                            heading: 'Error'
                            , text: message
                            , position: 'top-right'
                            , loaderBg: '#FB9678'
                            , icon: 'error'
                            , hideAfter: 3500
                            , stack: 6
                        });
                    });
                },
                success: function (file, response, xhr) {
                    response = jQuery.parseJSON(response);
                    rejectedImports(response.result.rejected);
                    this.removeFile(file);
                    btnUndo.attr('data-import', response.result.importid);
                    btnUndo.fadeIn('fast');
                    btnFinishPage.fadeIn('fast');
                    $.toast({
                        heading: response.title
                        , text: response.message
                        , position: 'top-right'
                        , icon: response.status
                        , hideAfter: 3500
                        , stack: 6
                    });
                },
                maxfilesexceeded: function (file) {
                    this.removeFile(file);
                    $.toast({
                        heading: 'Warning'
                        , text: 'Je kan maar een lijst per keer uploaden'
                        , position: 'top-right'
                        , loaderBg: '#ffdf00'
                        , icon: 'warning'
                        , hideAfter: 3500
                        , stack: 6
                    });
                }
            };
            function rejectedImports(rows) {
                var rejects = "";
                $.each(rows, function(index, row) {
                    var date = null;
                    if (row.geboorte_datum === null) {
                        date = "";
                    }else {
                        date = row.geboorte_datum.date;
                    }
                    rejects = rejects + '' +
                        '<tr>' +
                            '<td>'+ row.naam_deelnemer +'</td>' +
                            '<td>'+ row.naam_college +'</td>' +
                            '<td>'+ row.naam_team +'</td>' +
                            '<td>'+ date +'</td>' +
                            '<td>'+ row.functie +'</td>' +
                            '<td>'+ row.training_verzorgd_door +'</td>' +
                            '<td>'+ row.diploma_uitgegeven_door +'</td>' +
                            '<td>'+ row.naam_teamleider_1_persoon +'</td>' +
                            '<td>'+ row.status_actief_non_actief_anders +'</td>' +
                            '<td>'+ row.basistraining_behaald_janee +'</td>' +
                        '</tr>'
                });
                el_rejects.append('' +
                    '<div class="table-responsive">' +
                        '<table class="table table-bordered">' +
                            '<thead>' +
                                '<tr>' +
                                    '<th>Naam deelnemer <span class="text-danger">*</span></th>' +
                                    '<th>Naam College</th>' +
                                    '<th>Naam Team</th>' +
                                    '<th>Geboorte Datum</th>' +
                                    '<th>Functie <span class="text-danger">*</span></th>' +
                                    '<th>Training verzorgd door</th>' +
                                    '<th>Diploma uitgegeven door</th>' +
                                    '<th>Naam Teamleider (1 Persoon)</th>' +
                                    '<th>Status (Actief, Non-actief, Anders) <span class="text-danger">*</span></th>' +
                                    '<th>Basistraining behaald (Ja/Nee)</th>' +
                                '</tr>' +
                            '</thead>' +
                            '<tbody>' +
                                rejects +
                            '</tbody>' +
                        '</table>' +
                    '</div>');
                rejectContainer.slideDown('fast');
            }

            el_wizard.wizard({
                buttonLabels: {
                    next: 'Volgende',
                    back: 'Terug',
                    finish: 'Upload'
                },
                onNext: function () {
                    if (tabUitleg.is(".current")) {
                        table_uitleg.show('fast');
                        tabHideShow.show('fast');
                    } else {
                        table_uitleg.hide('fast');
                        tabHideShow.hide('fast');
                    }
                },
                onBack: function () {
                    if (tabUitleg.is(".current")) {
                        table_uitleg.show('fast');
                        tabHideShow.show('fast');
                        paddingFix.css('padding-left', '0px');
                        paddingFix.css('padding-right', '0px');
                    } else {
                        table_uitleg.hide('fast');
                        tabHideShow.hide('fast');
                        paddingFix.css('padding-left', '25px');
                        paddingFix.css('padding-right', '25px');
                    }
                },
                onFinish: function () {
                    $.toast({
                        heading: 'Een moment geduld...'
                        , text: 'Het systeem is nu uw bestand aan het verwerken.'
                        , position: 'top-right'
                        , loaderBg: '#ffdf00'
                        , icon: 'info'
                        , hideAfter: 3500
                        , stack: 6
                    });
                    ob_dropzone.processQueue();
                }
            });
            btnDownload.click(function () {
                var win = window.open('{!! URL::route('download_excel_assessor_layout') !!}', '_blank');
                if (win) {
                    //Browser has allowed it to be opened
                    win.focus();
                } else {
                    //Browser has blocked it
                    $.toast({
                        heading: 'Warning'
                        , text: 'Kon geen nieuw venster openen,<br> Zet "sta pop-ups toe" aan...)'
                        , position: 'top-right'
                        , loaderBg: '#ffdf00'
                        , icon: 'warning'
                        , hideAfter: 3500
                        , stack: 6
                    });
                }
            });

            btnUndo.click(function () {
                var importid = $(this).attr('data-import');
                var url = "{!! URL::route('add_assessor_automatic_undo', 'none') !!}";
                    url = url.replace('none', '');
                $.getJSON( url+importid, function( response ) {
                    $.toast({
                        heading: "Status Ongedaan maken"
                        , text: response.message
                        , position: 'top-right'
                        , loaderBg: response.color
                        , icon: response.type
                        , hideAfter: 3000
                        , stack: 6
                    });
                });
            });

            btnFinishPage.click(function (e) {
                e.stopPropagation();
                e.preventDefault();
                window.location.href = "{!! URL::route('assessors') !!}";
            })
        });
    </script>
@stop