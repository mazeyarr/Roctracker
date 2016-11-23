@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="white-box">
            <div class="row row-in">
                <div class="col-lg-4 col-sm-6 row-in-br">
                    <div class="col-in row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <i class="linea-icon linea-basic" data-icon="E"></i>
                            <h5 class="text-muted vb">Actieve Assesoren</h5>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <h3 class="counter text-right m-t-15 text-danger">23</h3>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="progress">
                                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" class="progress-bar progress-bar-danger" role="progressbar" style="width: 40%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 row-in-br">
                    <div class="col-in row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <i class="linea-icon linea-basic" data-icon="&#xe00b;"></i>
                            <h5 class="text-muted vb">Aantal Teamleiders</h5>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <h3 class="counter text-right m-t-15 text-primary">157</h3>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="progress">
                                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" class="progress-bar progress-bar-primary" role="progressbar" style="width: 40%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 b-0">
                    <div class="col-in row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <i class="linea-icon linea-basic" data-icon="&#xe016;"></i>
                            <h5 class="text-muted vb">All PROJECTS</h5>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <h3 class="counter text-right m-t-15 text-success">431</h3>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="progress">
                                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" class="progress-bar progress-bar-success" role="progressbar" style="width: 40%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--row -->
<!-- /.row -->
<div class="row">
    <div class="col-md-7 col-lg-9 col-sm-12 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">Yearly Sales</h3>
            <ul class="list-inline text-right">
                <li>
                    <h5><i class="fa fa-circle m-r-5" style="color: #00bfc7;"></i>iPhone</h5>
                </li>
                <li>
                    <h5><i class="fa fa-circle m-r-5" style="color: #fb9678;"></i>iPad</h5>
                </li>
                <li>
                    <h5><i class="fa fa-circle m-r-5" style="color: #9675ce;"></i>iPod</h5>
                </li>
            </ul>
            <div id="morris-area-chart" style="height: 340px;"></div>
        </div>
    </div>
    <div class="col-md-5 col-lg-3 col-sm-6 col-xs-12">
        <div class="bg-theme-dark m-b-15">
            <div class="row weather p-20">
                <div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 m-t-40">
                    <h3>&nbsp;</h3>
                    <h1>73<sup>°F</sup></h1>
                    <p class="text-white">AHMEDABAD, INDIA</p>
                </div>
                <div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 text-right">
                    <i class="wi wi-day-cloudy-high"></i><br>
                    <br>
                    <b class="text-white">SUNNEY DAY</b>
                    <p class="w-title-sub">April 14</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5 col-lg-3 col-sm-6 col-xs-12">
        <div class="bg-theme m-b-15">
            <div class="carousel vcarousel slide p-20" id="myCarouse2">
                <!-- Carousel items -->
                <div class="carousel-inner">
                    <div class="active item">
                        <h3 class="text-white">My Acting blown <span class="font-bold">Your Mind</span> and you also laugh at the moment</h3>
                        <div class="twi-user">
                            <img alt="user" class="img-circle img-responsive pull-left" src="../plugins/images/users/hritik.jpg">
                            <h4 class="text-white m-b-0">Govinda</h4>
                            <p class="text-white">Actor</p>
                        </div>
                    </div>
                    <div class="item">
                        <h3 class="text-white">My Acting blown <span class="font-bold">Your Mind</span> and you also laugh at the moment</h3>
                        <div class="twi-user">
                            <img alt="user" class="img-circle img-responsive pull-left" src="../plugins/images/users/genu.jpg">
                            <h4 class="text-white m-b-0">Govinda</h4>
                            <p class="text-white">Actor</p>
                        </div>
                    </div>
                    <div class="item">
                        <h3 class="text-white">My Acting blown <span class="font-bold">Your Mind</span> and you also laugh at the moment</h3>
                        <div class="twi-user">
                            <img alt="user" class="img-circle img-responsive pull-left" src="../plugins/images/users/ritesh.jpg">
                            <h4 class="text-white m-b-0">Govinda</h4>
                            <p class="text-white">Actor</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--row -->

@stop