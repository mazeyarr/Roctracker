<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                <div><img alt="user-img" class="img-circle" src="plugins/images/users/varun.jpg"></div>{{ Auth::user()->name }}</a>
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
                <a class="waves-effect" href="{{ URL::route('dashboard') }}"><i class="linea-icon linea-basic fa-fw" data-icon="a"></i> <span class="hide-menu">Dashboard <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">##</a>
                    </li>
                    <li>
                        <a href="#">##</a>
                    </li>
                    <li>
                        <a href="#">##</a>
                    </li>
                    <li>
                        <a href="#">##</a>
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