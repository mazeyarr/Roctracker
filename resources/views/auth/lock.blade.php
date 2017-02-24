<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <title>RocTracker - Locked</title>
    <!-- Bootstrap Core CSS -->
    {!! Html::style('bootstrap/dist/css/bootstrap.min.css') !!}
    <!-- animation CSS -->
    {!! Html::style('css/animate.css') !!}
    <!-- Custom CSS -->
    {!! Html::style('css/style.css') !!}
    <!-- color CSS -->
    {!! Html::style('css/colors/blue.css') !!}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
    <div class="login-box">
        <div class="white-box">
            {!! Form::open(['route' => 'unlock', 'class' => 'form-horizontal form-material', 'id' => 'Loginform', 'data-toggle' => 'validator']) !!}
                <div class="form-group">
                    <div class="col-xs-12 text-center">
                        <div class="user-thumb text-center"> <img alt="thumbnail" class="img-circle" width="100" src="{!! URL::asset('plugins/images/users/default-user.png') !!}">
                            <h3>{{ Auth::user()->name }}</h3>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        {!! Form::password('password', ['class' => 'form-control', 'required' => '', 'placeholder' => 'Password']) !!}
                    </div>
                </div>
                <div class="form-group text-center">
                    <div class="col-xs-12">
                        {!! Form::button('login', ['class' => 'btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light', 'type' => 'submit']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>
<!-- jQuery -->
{!! Html::script('plugins/bower_components/jquery/dist/jquery.min.js') !!}
<!-- Bootstrap Core JavaScript -->
{!! Html::script('bootstrap/dist/js/bootstrap.min.js') !!}
<!-- Menu Plugin JavaScript -->
{!! Html::script('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') !!}

<!--slimscroll JavaScript -->
{!! Html::script('js/jquery.slimscroll.js') !!}
<!--Wave Effects -->
{!! Html::script('js/waves.js') !!}
<!-- Custom Theme JavaScript -->
{!! Html::script('js/custom.min.js') !!}
<!--Style Switcher -->
{!! Html::script('plugins/bower_components/styleswitcher/jQuery.style.switcher.js') !!}
<!-- Validator -->
{!! Html::script('js/validator.js') !!}
</body>
</html>
