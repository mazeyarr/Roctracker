<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <title>RocTracker</title>
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
    <div class="login-box login-sidebar">
        <div class="white-box">
            {!! Form::open(['url' => 'login', 'class' => 'form-horizontal form-material', 'id' => 'Loginform', 'data-toggle' => 'validator']) !!}
                <a href="javascript:void(0)" class="text-center db"><h1><span style="color: #059B9A;">Roc</span>Tracker</h1></a>
                @if ($errors->has('email'))
                    <div class="form-group m-t-40 has-error">
                        <div class="col-xs-12">
                            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'required' => '', 'autofocus' => '']) !!}
                        </div>
                    </div>
                @else
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'required' => '', 'autofocus' => '']) !!}
                        </div>
                    </div>
                @endif

                @if ($errors->has('password'))
                    <div class="form-group has-error">
                        <div class="col-xs-12">
                            {!! Form::password('password', ['class' => 'form-control', 'required' => '', 'placeholder' => 'Wachtwoord']) !!}
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <div class="col-xs-12">
                            {!! Form::password('password', ['class' => 'form-control', 'required' => '', 'placeholder' => 'Wachtwoord']) !!}
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <div class="col-md-12">
                        <div class="checkbox checkbox-primary pull-left p-t-0">
                            {!! Form::checkbox('remember_me', 0,0,['id' => 'checkbox-signup']) !!}
                            <label for="checkbox-signup"> Onthoud mij </label>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
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
