@extends('layouts.app')

@section('title', 'Onderhouds Groepen')

@section('page-title', 'Onderhouds Groepen')

@section('content')
    @if(!empty($groups))
    <div class="row">
        @foreach($groups as $group)
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"> {{ $group->title }}
                </div>
                <div class="panel-body">
                    <form class="floating-labels form-maintenances" data-toggle="validator" id="form-group-{{$group->fk_maintenances->id}}">
                        <div class="form-group m-b-40 m-t-20">
                            {!! Form::text('institution-' . $group->title, $group->fk_maintenances->institution, array('data-group' => $group->id, 'class' => 'form-control _institution', 'id' => 'institution-' . $group->fk_maintenances->id, 'required' => '')) !!}
                            <span class="highlight"></span> <span class="bar"></span>
                            <label for="institution-{{$group->fk_maintenances->id}}">Instelling</label>
                        </div>
                        <div class="form-group m-b-40">
                            {!! Form::text('location-' . $group->title, $group->fk_maintenances->location, array('data-group' => $group->id, 'class' => 'form-control _locatation', 'id' => 'location-' . $group->fk_maintenances->id, 'required' => '')) !!}
                            <span class="highlight"></span> <span class="bar"></span>
                            <label for="locatation-{{$group->fk_maintenances->id}}">Locatie</label>
                        </div>
                        <div class="form-group m-b-40">
                            {!! Form::text('from-' . $group->title, !empty($group->fk_maintenances->from) ? date_format(date_create_from_format('Y-m-d H:i:s', $group->fk_maintenances->from), 'd-m-Y') : null, array('data-group' => $group->id, 'class' => 'form-control _from', 'id' => 'from-' . $group->fk_maintenances->id, 'required' => '')) !!}
                            <span class="highlight"></span> <span class="bar"></span>
                            <label for="from-{{$group->fk_maintenances->id}}">Van: (dd-mm-yyyy)</label>
                        </div>
                        <div class="form-group m-b-40">
                            {!! Form::text('till-' . $group->title, !empty($group->fk_maintenances->till) ? date_format(date_create_from_format('Y-m-d H:i:s', $group->fk_maintenances->till), 'd-m-Y') : null, array('data-group' => $group->id, 'class' => 'form-control _till', 'id' => 'till-' . $group->fk_maintenances->id, 'required' => '')) !!}
                            <span class="highlight"></span> <span class="bar"></span>
                            <label for="till-{{$group->fk_maintenances->id}}">Tot: (dd-mm-yyyy)</label>
                        </div>
                    </form>
                    <hr>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Naam</th>
                            <th>College</th>
                            <th>Teamleider</th>
                        </tr>
                        </thead>
                        <tbody id="groupContainer">
                            <?php $rowCount = 1; ?>
                            @foreach($group->participants->participants as $participant)
                                @include('partials._maintenancePage._panel', [
                                    'row_ID' => 'row-'.$rowCount.$group->id,
                                    'rowCount' => $rowCount,
                                    'select_NAME' => 'row-'.$rowCount.$group->id,
                                    'select_ID' => 'select-row-'.$rowCount.'-group-'.$group->id,
                                    'option_VALUE' => $participant->id,
                                    'option_innerHTML' => $participant->name,
                                    'groupID' => $group->id,
                                    'participantCollege' => \App\College::find($participant->fk_college),
                                    'participantTeamleader' => \App\Teamleaders::find($participant->fk_teamleader),
                                    'assessors' => $assessors
                                ])
                            <?php $rowCount++; ?>
                            @endforeach
                            @if($rowCount != 1)
                                @for($i = $rowCount; $i <= 16; $i++)
                                    @include('partials._maintenancePage._panel', [
                                        'row_ID' => 'row-'.$i.$group->id,
                                        'rowCount' => $i,
                                        'select_NAME' => 'row-'.$i.$group->id,
                                        'select_ID' => 'select-row-'.$i.'-group-'.$group->id,
                                        'option_VALUE' => null,
                                        'option_innerHTML' => null,
                                        'groupID' => $group->id,
                                        'assessors' => $assessors
                                    ])
                                @endfor
                            @else
                                @for($i = $rowCount; $i <= 16; $i++)
                                    @include('partials._maintenancePage._panel', [
                                        'row_ID' => 'row-'.$i.$group->id,
                                        'rowCount' => $i,
                                        'select_NAME' => 'row-'.$i.$group->id,
                                        'select_ID' => 'select-row-'.$i.'-group-'.$group->id,
                                        'option_VALUE' => null,
                                        'option_innerHTML' => null,
                                        'groupID' => $group->id,
                                        'assessors' => $assessors
                                    ])
                                @endfor
                            @endif
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-12">
                            <button id="btnDelete-{{$group->id}}{{$group->year}}" data-group-title="{{$group->title}}" data-group="{{$group->id}}" class="btnDelete btn btn-danger btn-block">Verwijderen</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <button id="btnAdd" class="btn btn-success btn-circle btn-xl" style="float: right; padding-top: 15px;"><i class="fa fa-plus"></i></button>
        </div>
    </div>
@stop

@section('scripts')
    @include('partials._javascript-alerts')
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
        $(document).ready(function () {
            var body = $('body'),
                _select = $('.select-assessor'),
                _institutionMaintenances = $('._institution'),
                _locationMaintenances = $('._locatation'),
                _fromMaintenances = $('._from'),
                _tillMaintenances = $('._till'),
                _btnAdd = $('#btnAdd'),
                _btnDelete = $('.btnDelete'),
                deleteGroupID = null;

            _btnAdd.click(function (e) {
                $.getJSON('{!! URL::route('add_new_assessor_groups') !!}', function (response) {
                    console.log(response);
                    if (response) {
                        ezToast('Gelukt!', "Nieuwe groep aangemaakt !, een moment...", 'success', 2000, "#5cb85c");
                        window.location.reload();
                    }else {
                        ezToast('Error', "Er is iets misgegaan", 'error', 2000, "#d9534f");
                    }
                })
            });
            _institutionMaintenances.keyup(function (e) {
                var maintenance_id = this.id;
                maintenance_id = maintenance_id.replace('institution-', '');
                if ($(this).val() == "") {
                    var input = $(this).closest('.form-group');
                    input.removeClass('has-error');
                    input.removeClass('has-success');
                    input.removeClass('has-feedback');
                    input.addClass('has-error');
                    input.addClass('has-feedback');
                    return;
                }
                saveMaintenanceData(maintenance_id, $(this).attr('data-group'), 'institution', $(this).val(), $(this));

            });
            _locationMaintenances.keyup(function (e) {
                var maintenance_id = this.id;
                maintenance_id = maintenance_id.replace('location-', '');
                if ($(this).val() == "") {
                    var input = $(this).closest('.form-group');
                    input.removeClass('has-error');
                    input.removeClass('has-success');
                    input.removeClass('has-feedback');
                    input.addClass('has-error');
                    input.addClass('has-feedback');
                    return;
                }
                saveMaintenanceData(maintenance_id, $(this).attr('data-group'), 'location', $(this).val(), $(this));

            });
            _fromMaintenances.keyup(function (e) {
                var maintenance_id = this.id;
                maintenance_id = maintenance_id.replace('from-', '');
                if ($(this).val() == "") {
                    var input = $(this).closest('.form-group');
                    input.removeClass('has-error');
                    input.removeClass('has-success');
                    input.removeClass('has-feedback');
                    input.addClass('has-error');
                    input.addClass('has-feedback');
                    return;
                }
                saveMaintenanceData(maintenance_id, $(this).attr('data-group'), 'from', $(this).val(), $(this));

            });
            _tillMaintenances.keyup(function (e) {
                var maintenance_id = this.id;
                maintenance_id = maintenance_id.replace('till-', '');
                if ($(this).val() == "") {
                    var input = $(this).closest('.form-group');
                    input.removeClass('has-error');
                    input.removeClass('has-success');
                    input.removeClass('has-feedback');
                    input.addClass('has-error');
                    input.addClass('has-feedback');
                    return;
                }
                saveMaintenanceData(maintenance_id, $(this).attr('data-group'), 'till', $(this).val(), $(this));

            });

            body.on('change', _select, function (event) {
                var name = event.target.name;
                if (name.indexOf("row") < 0) { return; }
                var rowID = event.target.name,
                    assessorID = event.target.value,
                    _row = $('#' + rowID),
                    groupID = _row.attr('data-group'),
                    replacementID = _row.attr('data-replacement'),
                    _collegeCell = $('#'+_row.attr('data-college')),
                    _teamleaderCell = $('#'+_row.attr('data-teamleader'));
                placeInGroup(assessorID, replacementID, groupID);
                showAssessorData(assessorID, _collegeCell, _teamleaderCell);
            });

            body.on('click', _btnDelete, function (event) {
                var name = event.target.id;
                if (name.indexOf("btnDelete") < 0) { return; }
                var btnID = event.target.id,
                    button = $('#' + btnID),
                    group = button.attr('data-group');

                swal({
                    title:"Groep Verwijderen",
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
                        ezToast('Attentie !', "Verwijderen Geannuleerd", 'warning', 2000, "#FEC107");
                        swalShowLoad(false);
                    }else{
                        swalShowLoad(true);
                        $.getJSON('{!! URL::route('ajax_check_user_password',null) !!}/' + inputValue, function (response) {
                            if (response) {
                                $.getJSON('{!! URL::route('remove_assessor_group', null) !!}/' + group, function (response) {
                                    if (response) {
                                        ezToast('Gelukt!', "Groep is verwijderd !", 'success', 2000, "#5cb85c");
                                        window.location.reload();
                                    }else {
                                        ezToast('Error', "Er is iets misgegaan, probeer het opnieuw !", 'error', 2000, "#d9534f");
                                        window.location.reload();
                                    }
                                });
                            }else{
                                swalShowLoad(false);
                                swal.showInputError("Wachtwoord was incorrect...");
                            }
                        });
                    }
                });
            });

            function saveMaintenanceData(id, group, name, value, element) {
                $.post("{!! URL::route('post_maintenance_data') !!}",
                {
                    id: id,
                    group: group,
                    name: name,
                    value: value,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                function(data){
                    var input = element.closest('.form-group');
                    input.removeClass('has-error');
                    input.removeClass('has-success');
                    input.removeClass('has-feedback');
                    if (data == "true") {
                        input.addClass('has-success');
                        input.addClass('has-feedback');
                    }else{
                        input.addClass('has-error');
                        input.addClass('has-feedback');
                    }
                });
            }
            function placeInGroup(id, replacementID, groupID) {
                if (replacementID == "") replacementID = null;
                $.post("{!! URL::route('post_maintenance_assessor_groups') !!}",
                {
                    id_a: id,
                    replace_id: replacementID,
                    id_g: groupID,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                function(data){
                    if (data == "true") {
                        ezToast('Groep Aangepast', "Assessor is opgeslagen in groep", "success", 2000, "#5cb85c");
                    }else {
                        ezToast('Error', "Er was een fout check even of u voldoet aan alle eisen", "error", 2000, "#d9534f");
                    }
                });
            }
            function showAssessorData(id, _el1, _el2) {
                showLoad(_el1, true);
                showLoad(_el2, true);
                $.getJSON('{{URL::route('ajax_get_assessor_info',null)}}/' + id, function (response) {
                    showLoad(_el1, false);
                    showLoad(_el2, false);
                    if (response){
                        _el1.append(response.fk_college.name);
                        _el2.append(response.fk_teamleader.name);
                    }
                });
            }
            function emptyEL (element) {
                element.html('');
            }
            function showLoad (element, bool) {
                emptyEL(element);
                if (bool) element.append('<i class="fa fa-circle-o-notch fa-spin"></i>');
                if (!bool) emptyEL(element);
            }
        });
    </script>
@stop