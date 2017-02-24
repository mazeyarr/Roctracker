<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <a class="navbar-toggle hidden-sm hidden-md hidden-lg" data-target=".navbar-collapse" data-toggle="collapse"
           href="javascript:void(0)"><i class="ti-menu"></i></a>
        <div class="top-left-part" style="padding-top: 10px;">
            <a class="logo" href="{{ URL::route('dashboard') }}">
                <b><!--This is dark logo icon-->
                    <img alt="home" class="dark-logo" src="{{ URL::asset('plugins/images/RocTrackerLogo.png') }}">
                </b>
                <span class="hidden-xs"><!--This is dark logo text-->
                    <img alt="home" class="dark-logo" src="{{ URL::asset('plugins/images/headerimg.png') }}">
                </span>
            </a>
        </div>
        <ul class="nav navbar-top-links navbar-left hidden-xs">
            <li>
                <a class="open-close hidden-xs waves-effect waves-light" href="javascript:void(0)"><i
                            class="icon-arrow-left-circle ti-menu"></i></a>
            </li>
            <li>
                <form class="app-search hidden-xs" role="search">
                    <input class="form-control" placeholder="Zoeken" type="text"> <a href="#">
                        <i class="fa fa-search"></i></a>
                </form>
            </li>
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">
            <li class="dropdown">
                <a class="dropdown-toggle waves-effect waves-light" href="{!! URL::route('idle') !!}">
                    <i class="fa fa-lock" aria-hidden="true"></i></a>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle waves-effect waves-light" href="{!! URL::route('logout') !!}"><i
                            class="icon-logout"></i></a>
            </li><!-- /.dropdown -->
        </ul>
    </div><!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav><!-- Left navbar-header -->