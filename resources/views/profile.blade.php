@extends('layouts.app')

@section('title', 'Uw Profiel')

@section('page-title', $user->name)

@section('content')
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="white-box">
                <div class="user-bg"> <img width="100%" alt="user" src="{{URL::asset('plugins/images/large/img1.jpg')}}">
                    <div class="overlay-box">
                        <div class="user-content">
                            <a href="javascript:void(0)"><img src="{{!empty($user->avatar) ? URL::asset($user->avatar) : URL::asset('plugins/images/users/default-user.png')}}" class="thumb-lg img-circle" alt="img"></a>
                            <h4 class="text-white">{{$user->name}}</h4>
                            <h5 class="text-white">{{$user->email}}</h5>
                        </div>
                    </div>
                </div>
                <div class="user-btm-box">
                    {!! Form::open(array('route' => 'profile_save', 'files' => true, 'class' => 'floating-labels form-maintenances', 'data-toggle' => 'validator')) !!}
                        <div class="form-group m-b-40 m-t-20">
                            {!! Form::text('name', $user->name,  array('class' => 'form-control', 'id' => 'name', 'required' => '')) !!}
                            <span class="highlight"></span> <span class="bar"></span>
                            <label for="name">Volledige Naam</label>
                        </div>

                        <div class="form-group m-b-40 m-t-20">
                            {!! Form::email('email', $user->email,  array('class' => 'form-control', 'id' => 'email', 'required' => '')) !!}
                            <span class="highlight"></span> <span class="bar"></span>
                            <label for="name">Volledige Naam</label>
                        </div>

                        <div class="form-group m-b-40 m-t-20">
                            <div class="white-box">
                                <h3 class="box-title">Profiel Foto</h3>
                                {!! Form::file('avatar', array('id'=> 'avatar', 'class' => 'dropify', 'data-allowed-file-extensions' => 'jpeg png jpg', 'data-default-file' => !empty($user->avatar) ? URL::asset($user->avatar) : URL::asset('plugins/images/users/default-user.png'), 'data-max-file-size' => '3M')) !!}
                            </div>
                        </div>

                        <div class="form-group m-b-40 m-t-20">
                            <div class="white-box">
                                <button class="btn btn-success waves-effect waves-light" type="submit"><span class="btn-label"><i class="fa fa-save"></i></span>Opslaan</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @include('partials._javascript-alerts')
    {!! Html::script('plugins/bower_components/dropify/dist/js/dropify.min.js') !!}
    <script type="text/javascript">
        $(document).ready(function() {
            // Basic
            $('#avatar').dropify({
                messages: {
                    'default': 'Sleep of Click om uw foto te uploaden',
                    'replace': 'Sleep of Click om deze foto te vervangen',
                    'remove':  'Verwijderen',
                    'error':   'Mislukt, De foto kon niet worden geupload...'
                }
            });
        });
    </script>
@stop