<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                <a href="{{URL::route('profile')}}" class="btn"><div><img alt="user-img" class="img-circle" src="{{!empty(Auth::user()->avatar) ? URL::asset(Auth::user()->avatar) : URL::asset('plugins/images/users/default-user.png')}}"></div><span class="hide-menu">{{ Auth::user()->name }}</span></a>
            </div>
        </div>
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input class="form-control" placeholder="Zoeken..." type="text"> <span class="input-group-btn"><button class="btn btn-default" type="button"><span class="input-group-btn"><i class="fa fa-search"></i></span></button></span>
                </div><!-- /input-group -->
            </li>
            <li class="nav-small-cap m-t-10">--- ROC Ter AA</li>
            <li>
                <a class="waves-effect" href="{{ URL::route('dashboard') }}"><i class="linea-icon linea-basic fa-fw" data-icon="a"></i> <span class="hide-menu">Dashboard</span></a>
            </li>
            <li>
                <a class="waves-effect" href="{{ URL::route('colleges') }}"><i class="fa fa-graduation-cap fa-fw" data-icon="a"></i> <span class="hide-menu">Colleges{!! \App\College::all()->count() != 0 ? '<span class="fa arrow"></span>' : ""!!}</span></a>
                @if(\App\College::all()->count() != 0)
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="waves-effect" href="{{ URL::route('add_college') }}"><i class="fa fa-plus"></i> <span class="hide-menu">Toevoegen</span></a>
                        </li>
                        <li>
                            <a class="waves-effect" href="{{ URL::route('teamleaders') }}"><i class="fa fa-users"></i> <span class="hide-menu">Teamleiders</span></a>
                        </li>
                        <li>
                            <a class="waves-effect" href="{{ URL::route('assessors') }}"><i class="fa fa-user"></i> <span class="hide-menu">Assessoren</span></a>
                        </li>
                        <li>
                            <a class="waves-effect" href="{{ URL::route('maintenance_assessor') }}"><i class="fa fa-cogs"></i> <span class="hide-menu">Onderhoud</span></a>
                        </li>
                        @foreach(\App\College::all() as $nav_colleges)
                            <li>
                                <a class="waves-effect" href="{{ URL::route('view_colleges', $nav_colleges->id) }}"><i class="fa fa-bank"></i> {{ strlen($nav_colleges->name) > 15 ? substr($nav_colleges->name,0,15)."..." : $nav_colleges->name }}<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li> <a class="waves-effect" href="{{ URL::route('view_teamleaders', \App\TiC::where('fk_college', $nav_colleges->id)->first()->fk_teamleader) }}"><i class="fa fa-users"></i> <span class="hide-menu">Teamleider</span></a> </li>
                                    <li> <a class="waves-effect" href="{{ URL::route('assessors', $nav_colleges->id) }}"><i class="fa fa-user"></i> Assessoren</a> </li>
                                    <li> <a class="waves-effect" href="{{ URL::route('constructors') }}"><i class="fa fa-user"></i> Constructeurs</a> </li>
                                    <li> <a class="waves-effect" href="{{ URL::route('detectors') }}"><i class="fa fa-user"></i> Vaststellers</a> </li>
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
            <li>
                <a class="waves-effect" href="{{ URL::route('staff-exam-office') }}"><i class="fa fa-paperclip"></i> BEA<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li> <a class="waves-effect" href="javascript:void(0)"><i class="fa fa-users"></i> Kernfunctionaris</a> </li>
                    <li> <a class="waves-effect" href="javascript:void(0)"><i class="fa fa-users"></i> Medewerkers</a> </li>
                </ul>
            </li>
            <li>
                <a class="waves-effect" href="{{ URL::route('surveyors') }}"><i class="fa fa-crosshairs"></i> <span class="hide-menu"> Surveillanten</span></a>
            </li>
            <li>
                <a class="waves-effect" href="{{ URL::route('exam-comittee') }}"><i class="fa fa-flag"></i> <span class="hide-menu"> Examencommissie</span></a>
            </li>
            <li>
                <a class="waves-effect" href="{{ URL::route('advanced_search') }}"><i class="fa fa-search"></i> <span class="hide-menu"> Geavanceerd Zoeken</span></a>
            </li>
            <li>
                <a class="waves-effect" href="{{ URL::route('notification_overview') }}"><i class="fa fa-envelope fa-fw" data-icon="a"></i> <span class="hide-menu">Berichten <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL::route('notification_overview') }}"><i class="fa fa-list"></i> Overzicht</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('notification_create') }}"><i class="fa fa-plus"></i> Incidenteele</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><i class="fa fa-paper-plane"></i> Automatische</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="waves-effect" href="{{ URL::route('users') }}"><i class="fa fa-users"></i> <span class="hide-menu">Administratoren</span></a>
            </li>
            <li>
                <a class="waves-effect" href="{{ URL::route('logout') }}"><i class="icon-logout fa-fw"></i> <span class="hide-menu">Log uit</span></a>
            </li>
        </ul>
    </div>
</div><!-- Left navbar-header end -->