@extends('layouts.app')

@section('title', 'Groepen Maken / Wijzigen')

@section('page-title', 'Groepen Maken / Wijzigen')

@section('content')
    <div class="row">
        <div class="col-md-12" id="panelContainer">
            @if(!empty($maintenancedata))
                @foreach($maintenancedata as $group)
                    <div class="panel panel-info" id="panel-{{ $group->id }}">
                        <div class="panel-heading"> {{ $group->title }}
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4>Deelnemers</h4>
                                    </div>
                                    <div class="col-sm-6">
                                        <button id="{{ $group->id }}" data-panel-id="panel-{{ $group->id }}" data-name="{{ $group->title }}" class="delete btn btn-danger" style="float: right;">Verwijderen</button>
                                    </div>
                                </div>
                                <tr>
                                    <th>#</th>
                                    <th>Naam</th>
                                    <th>College</th>
                                    <th>Teamleider</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @if(!empty($group->participants->participants))
                                        @foreach($group->participants->participants as $assessor)
                                            <tr>
                                                <th scope="row">{{$i}}</th>
                                                <td>{{ $assessor->name }}</td>
                                                <td>{{ empty(\App\College::find($assessor->fk_college)) ? "Geen" : \App\College::find($assessor->fk_college)->name }}</td>
                                                <td>{{ empty(\App\Teamleaders::find($assessor->fk_teamleader)) ? "Geen" : \App\Teamleaders::find($assessor->fk_teamleader)->name }}</td>
                                            </tr>
                                            <?php $i++ ?>
                                        @endforeach
                                        @for($spots = (16 - count($group->participants->participants)); $spots > 0; $spots-- )
                                            <tr id="row-{{$i}}">
                                                <th scope="row">{{$i}}</th>
                                                <td>
                                                    <select class="participant" name="participant-{{$i}}" data-rowid="{{$i}}">
                                                        <option value="reserve">Reserve</option>
                                                        @foreach($assessors as $assessor)
                                                            <option value="{{ $assessor['assessor']->id }}">{{ $assessor['assessor']->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td id="row-college-{{$i}}"></td>
                                                <td id="row-teamleader-{{$i}}"></td>
                                            </tr>
                                            <?php $i++ ?>
                                        @endfor
                                    @else
                                        @for($spots = 16; $spots > 0; $spots-- )
                                            <tr id="row-{{$i}}">
                                                <th scope="row">{{$i}}</th>
                                                <td>
                                                    <select class="participant" name="participant-{{$i}}" data-rowid="{{$i}}">
                                                        <option value="reserve">Reserve</option>
                                                        @foreach($assessors as $assessor)
                                                            <option value="{{ $assessor['assessor']->id }}">{{ $assessor['assessor']->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td id="row-college-{{$i}}"></td>
                                                <td id="row-teamleader-{{$i}}"></td>
                                            </tr>
                                            <?php $i++ ?>
                                        @endfor
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <button id="btnSave" class="btn btn-success btn-circle btn-xl" style="padding-top: 15px;"><i class="fa fa-save"></i> </button>
        </div>
        <div class="col-sm-6">
            <button id="btnAddGroup" class="btn btn-primary btn-circle btn-xl" style="float: right; padding-top: 15px;"><i class="fa fa-plus"></i> </button>
        </div>
    </div>
@stop

@section('scripts')
    @include('partials._javascript-alerts')
    <script type="text/javascript">
        $(function(){
            $('.panel').lobiPanel({
                sortable: true,
                close: false,
                reload: false,
                editTitle: false,
                state: "collapsed"
            });
        });
        $(document).ready(function () {
            var container = $('#panelContainer'),
                btnAddGroup = $('#btnAddGroup'),
                btnSave = $('#btnSave'),
                panels = $('.panel'),
                _delete = $('.delete'),
                swal_title = "",
                body = $('body'),
                _participant = $('.participant');

            body.on('change', _participant, function ( event ) {
                return console.log(event.target);
                var id = event.target.value,
                    rowid = $(this).attr('data-rowid'),
                    _row = $('#row-' + rowid),
                    _cellCollege = $('#row-college-' + rowid),
                    _cellTeamleader = $('#row-teamleader-' + rowid);

                if (id == 'reserve') {
                    _cellCollege.html('');
                    _cellTeamleader.html('');
                    return;
                }

                _cellCollege.html('');
                _cellTeamleader.html('');
                _cellCollege.append('<i class="fa fa-circle-o-notch fa-spin"></i>');
                _cellTeamleader.append('<i class="fa fa-circle-o-notch fa-spin"></i>');
                $.getJSON('{!! URL::route('ajax_get_assessor_info', null) !!}/'+id, function(response) {
                    _cellCollege.html(response.fk_college.name);
                    _cellTeamleader.html(response.fk_teamleader.name);
                });
            });

            body.on('click', _delete, function (event) {
                var className = $(event.target).attr('class');
                if (className === "delete btn btn-danger") {
                    var t_btn = event.target,
                        groupid = t_btn.id,
                        btnDelete = $('#'+groupid);
                        swal_title = btnDelete.attr('data-name');
                    var t_panel = btnDelete.attr('data-panel-id'),
                        t_panel = $('#'+t_panel);

                }else {
                    return;
                }

                swal({
                    title: swal_title + " Verwijderen",
                    text: "U dient uw wachtwoord intevoeren voordat deze groep verwijderd kan worden",
                    type: "input",
                    inputType: "password",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    cancelButtonText: "Annuleren",
                    confirmButtonText: "Bevestigen",
                    animation: "slide-from-top",
                    inputPlaceholder: "Uw Wachtwoord"
                },
                function(inputValue){
                    swalShowLoad(true);
                    if (inputValue === "") {
                        swal.showInputError("U dient een wachtwoord intevoeren");
                        swalShowLoad(false);
                    }else if (!inputValue) {
                        ezToast('Attentie !', "Geannuleerd", 'warning', 2000, "#FEC107");
                        swalShowLoad(false);
                    }else{
                        swalShowLoad(true);
                        var url = '{!! URL::route('ajax_check_user_password', null) !!}'+ "/"+inputValue;
                        $.getJSON(url, function(response) {
                            if (response === true) {
                                url = "{!! URL::route('ajax_maintenance_remove_group', null) !!}/"+groupid;
                                $.getJSON(url, function(response) {
                                    if (response === true) {
                                        swal("Voltooid !", "Group was successvol verwijderd", "success");
                                        t_panel.hide(500);
                                        t_panel.remove();
                                    }
                                });
                            }else {
                                swal.showInputError("Uw wachtwoord was onjuist...");
                                swalShowLoad(false);
                            }
                        })
                        .fail(function(error) {
                            console.log(3);
                            console.log( error );
                            swalShowLoad(false);
                        });
                    }
                });
            });

            btnAddGroup.click(function () {
                $.getJSON('{!! URL::route('ajax_maintenance_add_group') !!}', function(data) {
                    container.append(data);
                    $('.panel').lobiPanel({
                        sortable: true,
                        close: false,
                        reload: false,
                        editTitle: false,
                        state: "collapsed"
                    });
                    ezToast('Voltooid', "De groep was successvol toegevoegd in het systeem", 'success', 2000, "#3cc25f");
                })
                .fail(function() {
                    ezToast('Error !', "Er was een fout opgetreden", 'error', 2000, "#ff6849");
                });
            });


        });
    </script>
@stop