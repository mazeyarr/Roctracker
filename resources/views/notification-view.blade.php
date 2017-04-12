@extends('layouts.app')

@section('title', 'Berichten Bekijken')

@section('page-title', "Onderwerp: " . $email->subject)

@section('content')
    <!-- row -->
    <div class="row">
        <!-- Left sidebar -->
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mail_listing">
                        <div class="media m-b-30 p-t-20">
                            <h4 class="font-bold m-t-0">{{ $email->subject }}</h4>
                            <hr>
                            <a class="pull-left" href="#"> <img class="media-object thumb-sm img-circle" src="{!! URL::asset('plugins/images/users/default-user.png') !!}" alt=""> </a>
                            <div class="media-body"> <span class="media-meta pull-right">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $email->updated_at)->format('d-m-Y | H:i') }}</span>
                                <h4 class="text-danger m-0">{{$email->to}}</h4>
                                <small class="text-muted">
                                    @if($teamleader)
                                        {{ $teamleader->name }}
                                    @endif
                                </small>
                            </div>
                        </div>
                        {!! $email->text !!}
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

@stop

@section('scripts')

@stop