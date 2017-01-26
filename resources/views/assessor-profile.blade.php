@extends('layouts.app')

@section('title', 'Assessoren')

@section('page-title', 'Assessoren')

@section('content')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <div class="white-box">
            <div class="user-bg"> <img width="100%" alt="user" src="{{ URL::asset('plugins/images/users/default-user.png') }}">
                <div class="overlay-box">
                    <div class="user-content">
                        <a href="javascript:void(0)"><img src="{{ URL::asset('plugins/images/users/default-user.png') }}" class="thumb-lg img-circle" alt="img"></a>
                        <h4 class="text-white">{{ $assessor->name }}</h4>
                        <h5 class="text-white">{{ !empty($assessor->fk_college) ? $assessor->fk_college->name : "Geen College" }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-xs-12">
        <div class="white-box">
            <ul class="nav nav-tabs tabs customtab">
                <li class="tab active">
                    <a href="#profile" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Overzicht</span> </a>
                </li>
                <li class="tab">
                    <a href="#overview" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-info"></i></span> <span class="hidden-xs">Messages</span> </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="profile">
                    <div class="row">
                        <div class="col-md-3 col-xs-6 b-r"> <strong>Volledige Naam</strong>
                            <br>
                            <p class="text-muted">{{ $assessor->name }}</p>
                        </div>
                        <div class="col-md-3 col-xs-6 b-r"> <strong>College</strong>
                            <br>
                            <p class="text-muted">{{ !empty($assessor->fk_college) ? $assessor->fk_college->name : "Geen College" }}</p>
                        </div>
                        <div class="col-md-3 col-xs-6 b-r"> <strong>Status</strong>
                            <br>
                            @if ($assessor->status == 0)
                                <span class="label label-table label-default m-t-20">Non actief</span>
                            @elseif ($assessor->status == 1)
                                <span class="label label-table label-success m-t-20">Actief</span>
                            @elseif ($assessor->status == 2)
                                <span class="label label-table label-warning m-t-20">Anders</span>
                            @endif
                        </div>
                        <div class="col-md-3 col-xs-6"> <strong>Geboortedatum</strong>
                            <br>
                            <p class="text-muted">{{  date("d-m-Y", strtotime($assessor->birthdate)) }}</p>
                        </div>
                    </div>
                    <hr>
                    <h4 class="font-bold m-t-30">Basistraining</h4>
                    <hr>
                    <h5>Portfolio <span class="pull-right">{{ ($assessor->fk_exams['basictraining']->requirements->portfolio) ? "100%" : "0%" }}</span></h5>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ ($assessor->fk_exams['basictraining']->requirements->portfolio) ? "100" : "0" }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ ($assessor->fk_exams['basictraining']->requirements->portfolio) ? "100%" : "0%" }}"> <span class="sr-only">{{ ($assessor->fk_exams['basictraining']->requirements->portfolio) ? "Voltooid" : "Niet Voltooid" }}</span> </div>
                    </div>
                    <h5>CV<span class="pull-right">{{ ($assessor->fk_exams['basictraining']->requirements->CV) ? "100%" : "0%" }}</span></h5>
                    <div class="progress">
                        <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="{{ ($assessor->fk_exams['basictraining']->requirements->CV) ? "100" : "0" }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ ($assessor->fk_exams['basictraining']->requirements->CV) ? "100%" : "0%" }}"> <span class="sr-only">{{ ($assessor->fk_exams['basictraining']->requirements->CV) ? "Voltooid" : "Niet Voltooid" }}</span> </div>
                    </div>
                    <h5>Filmpje <span class="pull-right">{{ ($assessor->fk_exams['basictraining']->requirements->video) ? "100%" : "0%" }}</span></h5>
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="{{ ($assessor->fk_exams['basictraining']->requirements->video) ? "100" : "0" }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ ($assessor->fk_exams['basictraining']->requirements->video) ? "100%" : "0%" }}"> <span class="sr-only">{{ ($assessor->fk_exams['basictraining']->requirements->video) ? "Voltooid" : "Niet Voltooid" }}</span> </div>
                    </div>
                    <br>
                    <h5>Dag 1 <span class="pull-right">{{ ($assessor->fk_exams['basictraining']->date1->present) ? "100%" : "0%" }}</span></h5>
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{ ($assessor->fk_exams['basictraining']->date1->present) ? "100" : "0" }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ ($assessor->fk_exams['basictraining']->date1->present) ? "100%" : "0%" }}"> <span class="sr-only">{{ ($assessor->fk_exams['basictraining']->date1->present) ? "Voltooid" : "Niet Voltooid" }}</span> </div>
                    </div>
                    <h5>Dag 2 <span class="pull-right">{{ ($assessor->fk_exams['basictraining']->date2->present) ? "100%" : "0%" }}</span></h5>
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{ ($assessor->fk_exams['basictraining']->date2->present) ? "100" : "0" }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ ($assessor->fk_exams['basictraining']->date2->present) ? "100%" : "0%" }}"> <span class="sr-only">{{ ($assessor->fk_exams['basictraining']->date2->present) ? "Voltooid" : "Niet Voltooid" }}</span> </div>
                    </div>
                </div>
                <div class="tab-pane" id="overview">
                    <div class="steamline">
                        <div class="sl-item">
                            <div class="sl-left"> <img src="{{ URL::asset('plugins/images/users/default-user.png') }}" alt="user" class="img-circle" /> </div>
                            <div class="sl-right">
                                <div class="m-l-40"> <a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                    <div class="m-t-20 row">
                                        <div class="col-md-2 col-xs-12"><img src="{{ URL::asset('plugins/images/users/default-user.png') }}" alt="user" class="img-responsive" /></div>
                                        <div class="col-md-9 col-xs-12">
                                            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa</p> <a href="#" class="btn btn-success"> Design weblayout</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="sl-item">
                            <div class="sl-left"> <img src="{{ URL::asset('plugins/images/users/default-user.png') }}" alt="user" class="img-circle" /> </div>
                            <div class="sl-right">
                                <div class="m-l-40"><a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                    <p>assign a new task <a href="#"> Design weblayout</a></p>
                                    <div class="m-t-20 row"><img src="{{ URL::asset('plugins/images/users/default-user.png') }}" alt="user" class="col-md-3 col-xs-12" /> <img src="{{ URL::asset('plugins/images/users/default-user.png') }}" alt="user" class="col-md-3 col-xs-12" /> <img src="../plugins/images/img3.jpg" alt="user" class="col-md-3 col-xs-12" /></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="sl-item">
                            <div class="sl-left"> <img src="{{ URL::asset('plugins/images/users/default-user.png') }}" alt="user" class="img-circle" /> </div>
                            <div class="sl-right">
                                <div class="m-l-40"><a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                    <p class="m-t-10"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="sl-item">
                            <div class="sl-left"> <img src="{{ URL::asset('plugins/images/users/default-user.png') }}" alt="user" class="img-circle" /> </div>
                            <div class="sl-right">
                                <div class="m-l-40"><a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                    <p>assign a new task <a href="#"> Design weblayout</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
<!-- /.row -->
@section('scripts')
    @include('partials._javascript-alerts')
    @include('partials._javascript-paddingfixer')
@stop