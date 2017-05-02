<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                <a href="{{URL::route('profile')}}" class="btn"><div><img alt="user-img" class="img-circle" src="{{!empty($user->avatar) ? Storage::url($user->avatar) : URL::asset('plugins/images/users/default-user.png')}}"></div>{{ Auth::user()->name }}</a>
            </div>
        </div>
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input class="form-control" placeholder="Zoeken..." type="text"> <span class="input-group-btn"><button class="btn btn-default" type="button"><span class="input-group-btn"><i class="fa fa-search"></i></span></button></span>
                </div><!-- /input-group -->
            </li>
            <li class="nav-small-cap m-t-10"><span style="font-size: 20px">&#10146;</span> Menu</li>
            <li>
                <a class="waves-effect" href="{{ URL::route('dashboard') }}"><i class="linea-icon linea-basic fa-fw" data-icon="a"></i> Dashboard</a>
            </li>
            <li>
                <a class="waves-effect" href="{{ URL::route('assessors') }}"><i class="fa fa-user"></i> Assessoren</a>
            </li>
            <li>
                <a class="waves-effect" href="{{ URL::route('teamleaders') }}"><i class="fa fa-users"></i> Teamleiders</a>
            </li>
            <li>
                <a class="waves-effect" href="{{ URL::route('colleges') }}"><i class="fa fa-graduation-cap"></i> Colleges</a>
            </li>
            <li>
                <a class="waves-effect" href="{{ URL::route('maintenance_assessor') }}"><i class="fa fa-cogs"></i> <span class="hide-menu">Onderhoud</span></a>
            </li>
            <li>
                <a class="waves-effect" href="{{ URL::route('constructors') }}"><i class="fa fa-futbol-o fa-fw" data-icon="a"></i> <span class="hide-menu">Functionarissen<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="waves-effect" href="{{ URL::route('constructors') }}"><i class="fa fa-bank"></i> Constructeurs</a>
                    </li>
                    <li>
                        <a class="waves-effect" href="{{ URL::route('detectors') }}"><i class="fa fa-bank"></i> Vaststellers</a>
                    </li>
                    <li>
                        <a class="waves-effect" href="{{ URL::route('exam-comittee') }}"><i class="fa fa-bank"></i> Examencommissie</a>
                    </li>
                    <li>
                        <a class="waves-effect" href="{{ URL::route('surveyors') }}"><i class="fa fa-bank"></i> Surveillanten</a>
                    </li>
                    <li>
                        <a class="waves-effect" href="{{ URL::route('staff-exam-office') }}"><i class="fa fa-bank"></i> Examenbureau</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="waves-effect" href="{{ URL::route('notification_overview') }}"><i class="fa fa-envelope fa-fw" data-icon="a"></i> <span class="hide-menu">Berichten <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL::route('notification_overview') }}"><i class="fa fa-list"></i> Overzicht</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('notification_create') }}"><i class="fa fa-plus"></i> Aanmaken</a>
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