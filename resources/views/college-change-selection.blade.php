@extends('layouts.app')

@section('title', 'Assessor Wijzegingen')

@section('page-title', $college_current->name.' <br>Assessor Wijzegingen')

@section('content')
    <!-- .row -->
    <div class="row el-element-overlay m-b-40">
        <div class="col-md-12">
            <h4>Assesors <br/><small>Hier kunt u de assessors indelen in de nieuwe colleges</small></h4>
            <hr>
        </div>
        @foreach($assessors as $assessor)
            <!-- /.usercard -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="white-box">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1"> <img src="{{ URL::asset('plugins/images/users/User-Default.jpg') }}" />
                            <div class="el-overlay">
                                <ul class="el-info">
                                    <li><a data-assessor-id="{{ $assessor->id }}" data-toggle="modal" data-target="#assessor-modal" class="btn default btn-outline" id="change-select"><i class="icon-settings"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="el-card-content">
                            <h3 class="box-title">{{ $assessor->name }}</h3> <small>{{ $assessor->function }}</small>
                            <br/> </div>
                    </div>
                </div>
            </div>
            <!-- /.usercard-->
        @endforeach
    </div>
    <!-- /.row -->

    {{-- Modal for little changes --}}
    <div class="modal fade" id="assessor-modal" tabindex="-1" role="dialog" aria-labelledby="assessor-modal-title">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="assessor-modal-title">Assessor wijziging</h4></div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form>
                                <div id="notification-block"></div>
                                <div class="form-group m-b-20">
                                    <label for="recipient-name" class="control-label">Opties:</label>
                                    <select class="form-control" id="college-options">
                                        <option value="{{ $college_current->id }}" selected>{{ $college_current->name }}</option>
                                        @foreach($colleges as $college)
                                            @if($college_current->id != $college->id)
                                                <option value="{{ $college->id }}">{{ $college->name }}</option>
                                            @endif
                                        @endforeach
                                        <option value="off">Non-actief</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
                    <button id="save" type="button" class="btn btn-primary">Opslaan</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @include('partials._javascript-alerts')
    <script>
        setInterval(function () {
            $('body').css('padding-right', '0px')
        }, 1000);
    </script>

    <script>
        $( document ).ready(function () {
            var assessor_id = null;

            var btnSave = $('#save'),
                selectCollege = $('#college-options'),
                assessor_card = $('#change-select'),
                notification_block = $('#notification-block');
            
            assessor_card.click(function () {
                assessor_id = $(this).attr('data-assessor-id');
            });
            
            btnSave.click(function () {
                var id = assessor_id;
                var option = selectCollege.val();

                $.ajax({
                    url: '/dashboard/college/save/assessor/'+ id +'/'+ option
                }).done(function (data) {
                    console.log(data);
                    $.toast({
                        heading: 'Voltooid'
                        , text: 'Assessor is opgeslagen !'
                        , position: 'top-right'
                        , icon: 'success'
                        , hideAfter: 1000
                    });

                    setTimeout(function () {
                        window.location.reload();
                    }, 800);
                }).fail(function () {
                    notification_block.append('<div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Error:</strong> Er is iets fout gegaan.</div>')
                });

            });

        });
    </script>
@stop