@extends('layouts.app')

@section('title', 'Teamleiders')

@section('page-title', 'Teamleiders')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <a href="{{ URL::route('add_teamleader') }}" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Teamleider toevoegen </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
                <table id="college-footable" class="table toggle-circle table-hover">
                    <thead>
                    <tr>
                        <th data-toggle="true"> Naam</th>
                        <th> College(s)</th>
                        <th data-hide="all"> Email</th>
                        <th data-hide="all"> Laatste bijwerking</th>
                        <th data-hide="all"></th>
                    </tr>
                    </thead>
                    <div class="form-inline padding-bottom-15">
                        <div class="row">
                            <div class="col-sm-12 text-left m-b-20">
                                <div class="form-group">
                                    <label class="form-inline"> Laat
                                        <select id="demo-show-entries" class="form-control input-sm">
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                        </select> Rijen zien.
                                    </label>
                                </div>
                                <div class="form-group" style="float: right;">
                                    <input id="footable-search" type="text" placeholder="Zoeken" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <tbody>
                    @if(!empty($teamleaders))
                        @foreach($teamleaders as $teamleader)
                            <tr>
                                {{--{{ !empty($teamleader['college']) ? $teamleader['college']->name : "Geen" }}--}}
                                <td>{{ $teamleader['teamleader']->name }}</td>
                                <td>
                                    @if(!empty($teamleader['college']))
                                        <?php $name = null; ?>
                                        @if(count($teamleader['college']) > 1)
                                            @foreach($teamleader['college'] as $college)
                                                <?php $name = $name . $college->name . " / "; ?>
                                            @endforeach
                                                {{ strlen($name) > 35 ? substr($name,0,35)."..." : rtrim($name, " / ") }}
                                        @else
                                            {{ strlen($teamleader['college'][0]->name) > 35 ? substr($teamleader['college'][0]->name,0,35)."..." : $teamleader['college'][0]->name }}
                                        @endif
                                    @endif
                                </td>
                                <td>{{ empty($teamleader['teamleader']->email) ? "Geen" : $teamleader['teamleader']->email  }}</td>
                                <td>{{ date_format($teamleader['teamleader']->updated_at, 'd-m-Y | H:i:s') }}</td>
                                <td>
                                    <a href="{{ URL::route('view_teamleaders', $teamleader['teamleader']->id) }}"
                                       class="college-row-big btn-xs btn-rounded btn-success">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                        Teamleider Bekijken
                                    </a>
                                    <span style="margin-left: 5px;"></span>
                                    <button data-toggle="modal" data-target="#teamleader-little-modal"
                                            id="{{ $teamleader['teamleader']->id }}"
                                            data-name="{{ $teamleader['teamleader']->name }}"
                                            data-team="{{ $teamleader['teamleader']->team }}"
                                            class="teamleader-row-little btn-xs btn-rounded btn-warning">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                        Bewerken
                                    </button>
                                    <a href="{{ URL::route('change_teamleaders', $teamleader['teamleader']->id) }}"
                                       id="{{ $teamleader['teamleader']->id }}"
                                       class="college-row-big btn-xs btn-rounded btn-danger">
                                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        Grote bewerking
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="5">
                            <div class="text-right">
                                <ul class="pagination pagination-split m-t-30"> </ul>
                            </div>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal for little changes --}}
    <div class="modal fade" id="teamleader-little-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel1">Wijzeging</h4></div>
                <div class="modal-body">
                    <form>
                        <div id="notification-block"></div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Naam:</label>
                            <input type="text" class="form-control" id="modal-name-field">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="save" type="button" class="btn btn-primary">Opslaan</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @include('partials._javascript-alerts')
    <!-- Footable -->
    <script src="{{ URL::asset('plugins/bower_components/footable/js/footable.all.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"
            type="text/javascript"></script>
    <!--FooTable init-->
    <script src="{{ URL::asset('js/footable-init.js') }}"></script>
    @include('partials._javascript-paddingfixer')
    <script>
        $( document ).ready( function () {

            var _id = null,
                _name = null;

            var modal_frame = $('#teamleader-little-modal'),
                notification_block = $('#notification-block'),
                modal_name_field = $('#modal-name-field'),
                btnSave = $('#save'),
                btnClose = $('#close'),
                btnTeamleader = $('.teamleader-row-little');

            btnTeamleader.click(function () {
                _id = this.id;
                _name = $(this).attr('data-name');
                modal_name_field.val(_name);
            });

            modal_name_field.focus(function () {
                modal_name_field.css('border', '1px solid #474F5B');
            });

            btnSave.click(function () {
                notification_block.hide(500);
                notification_block.empty();
                notification_block.show(500);

                /* Check if inputs contain a slash, to prevent routing errors */
                if (modal_name_field.val().indexOf('/') > -1) {
                    modal_name_field.css('border', '1px solid red');
                    notification_block.append('<div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Error:</strong> <b>"/"</b> is niet toegestaan.</div>');
                    return
                }
                /*Ajax with parameters*/
                $.ajax({
                    url: '/dashboard/teamleader/save/' + _id + '/' + modal_name_field.val()
                }).done(function (data) {
                    $.toast({
                        heading: 'Voltooid'
                        , text: 'Teamleider is opgeslagen !'
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