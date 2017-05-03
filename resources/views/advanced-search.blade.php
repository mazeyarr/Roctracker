@extends('layouts.app')

@section('title', 'Geavanceerd Zoeken')

@section('page-title', 'Geavanceerd Zoeken')

@section('content')
<!-- .row -->
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div id="container-advanced-search">
                <div class="row">
                    <div class="col-xs-12">
                        <h3 class="box-title">Uw Zoek Parameters</h3>
                        <form class="form-material form-horizontal" role="search">
                            <div class="form-group">
                                <label class="col-sm-12">Op wat/wie wilt u zoeken ?</label>
                                <div class="col-sm-12">
                                    {!! Form::select('searchOn', $search_tables, null, array('id' => 'advancedSearchOn', 'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div id="container-advanced-search-options">
                                @include('partials._advancedSearch._assessors-options')
                            </div>
                        </form>
                        {!! Form::button('<i class="fa fa-search"></i> Zoeken', array('id' => 'btnAdvancedSearch', 'class' => 'btn btn-info waves waves-effect')) !!}
                    </div>
                </div>
            </div>
            {{--<div id="advanced-search-results">
                <h2>Zoek Resultaten voor "Angular Js"</h2> <small>About 14,700 result ( 0.10 seconds)</small>
                <hr>
                <ul class="search-listing">
                    <li>
                        <h3><a href="javacript:void(0)">AngularJs</a></h3> <a href="javascript:void(0)" class="search-links">http://www.google.com/angularjs</a>
                        <p>Lorem Ipsum viveremus probamus opus apeirian haec perveniri, memoriter.Praebeat pecunias viveremus probamus opus apeirian haec perveniri, memoriter.</p>
                    </li>
                    <li>
                        <h3><a href="javacript:void(0)">AngularJS — Superheroic JavaScript MVW Framework</a></h3> <a href="javascript:void(0)" class="search-links">http://www.google.com/angularjs</a>
                        <     <p>Lorem Ipsum viveremus probamus opus apeirian haec perveniri, memoriter.Praebeat pecunias viveremus probamus opus apeirian haec perveniri, memoriter.</p>
                    </li>
                    <li>
                        <h3><a href="javacript:void(0)">AngularJS Tutorial - W3Schools</a></h3> <a href="javascript:void(0)" class="search-links">http://www.google.com/angularjs</a>
                        <p>Lorem Ipsum viveremus probamus opus apeirian haec perveniri, memoriter.Praebeat pecunias viveremus probamus opus apeirian haec perveniri, memoriter.</p>
                    </li>
                    <li>
                        <h3><a href="javacript:void(0)">Introduction to AngularJS - W3Schools</a></h3> <a href="javascript:void(0)" class="search-links">http://www.google.com/angularjs</a>
                        <p>Lorem Ipsum viveremus probamus opus apeirian haec perveniri, memoriter.Praebeat pecunias viveremus probamus opus apeirian haec perveniri, memoriter.</p>
                    </li>
                    <li>
                        <h3><a href="javacript:void(0)">AngularJS Tutorial</a></h3> <a href="javascript:void(0)" class="search-links">http://www.google.com/angularjs</a>
                        <p>Lorem Ipsum viveremus probamus opus apeirian haec perveniri, memoriter.Praebeat pecunias viveremus probamus opus apeirian haec perveniri, memoriter.</p>
                    </li>
                    <li>
                        <h3><a href="javacript:void(0)">Angular 2: One framework.</a></h3> <a href="javascript:void(0)" class="search-links">http://www.google.com/angularjs</a>
                        <p>Lorem Ipsum viveremus probamus opus apeirian haec perveniri, memoriter.Praebeat pecunias viveremus probamus opus apeirian haec perveniri, memoriter.</p>
                    </li>
                </ul>
                <ul class="pagination m-b-0">
                    <li class="disabled"> <a href="#"><i class="fa fa-angle-left"></i></a> </li>
                    <li> <a href="javascript:void(0)">1</a> </li>
                    <li class="active"> <a href="javascript:void(0)">2</a> </li>
                    <li> <a href="javascript:void(0)">3</a> </li>
                    <li> <a href="javascript:void(0)">4</a> </li>
                    <li> <a href="javascript:void(0)">5</a> </li>
                    <li> <a href="javascript:void(0)"><i class="fa fa-angle-right"></i></a> </li>
                </ul>
            </div>--}}
        </div>
    </div>
</div>
<!-- /.row -->
@stop

@section('scripts')
    @include('partials._javascript-alerts')
    <script type="text/javascript">
        $(document).ready(function () {
            var btnAdvancedSearch = $('#btnAdvancedSearch'),
                searchOn = $('#advancedSearchOn'),
                containerOptions = $('#container-advanced-search-options');

            searchOn.on('change', function () {
                var $this = $(this),
                    url = null;
                switch ($this.val()) {
                    case "assessors":
                        containerOptions.empty();
                        url = laroute.route('ajax_get_partial_view', { name : "_advancedSearch._assessors-options" });
                        $.get(url, function () {
                            m_loading();
                        }).done(function (data) {
                            containerOptions.append(data);
                            m_loadingSuccess();
                        }).fail(function () {
                            m_loadingFail();
                        });
                        break;
                    case "colleges":
                        containerOptions.empty();
                        url = laroute.route('ajax_get_partial_view', { name : "_advancedSearch._colleges-options" });
                        $.get(url, function () {
                            m_loading();
                        }).done(function (data) {
                            containerOptions.append(data);
                            m_loadingSuccess();
                        }).fail(function () {
                            m_loadingFail();
                        });
                        break;
                    case "teamleaders":
                        containerOptions.empty();
                        url = laroute.route('ajax_get_partial_view', { name : "_advancedSearch._teamleaders-options" });
                        $.get(url, function () {
                            m_loading();
                        }).done(function (data) {
                            containerOptions.append(data);
                            m_loadingSuccess();
                        }).fail(function () {
                            m_loadingFail();
                        });
                        break;
                    default:
                        containerOptions.empty();
                        break;
                }

                function m_loading() {
                    ezToast("Opties Ophalen", "Een moment geduld alstublieft", "info", 1000, "#337AB7");
                }

                function m_loadingSuccess() {
                    ezToast("Opties Opgehaald !", "", "success", 1500, "#53b751");
                }

                function m_loadingFail() {
                    ezToast("Er ging iets mis", "Probeer de pagina te verversen...", "danger", 2000, "#b77261");
                }
            });
        });
    </script>
@stop