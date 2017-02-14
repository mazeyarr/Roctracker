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
                        <li class="active" role="tab">
                            <h4><span>1</span>Inleiding</h4>
                        </li>
                        <li role="tab">
                            <h4><span>2</span>Uitleg</h4>
                        </li>
                        <li role="tab">
                            <h4><span>3</span>Importeren</h4>
                        </li>
                    </ul>
                    <div class="wizard-content">
                        <div class="wizard-pane active" role="tabpanel">

                        </div>
                        <div class="wizard-pane" role="tabpanel">

                        </div>
                        <div class="wizard-pane" role="tabpanel">
                            <!-- .row -->
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
                init: function() {
                    ob_dropzone = this;
                    this.on("error", function(file, response) {
                        this.removeFile(file);
                        var message = "";
                        if($.type(response) === "string") {
                            message = response;
                        }
                        else {
                            /*message = response.message;*/
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

            }

            el_wizard.wizard({
                buttonLabels: {
                    next: 'Volgende',
                    back: 'Terug',
                    finish: 'Upload'
                },
                onFinish: function () {
                    ob_dropzone.processQueue();
                }
            });
        });
    </script>
@stop