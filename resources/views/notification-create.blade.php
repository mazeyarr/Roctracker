@extends('layouts.app')

@section('title', 'Berichten Aanmaken')

@section('page-title', 'Berichten Aanmaken')

@section('content')
    <div class="row">
        @foreach($texts as $text)
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading"> {{$text->name}}
                    </div>
                    <div class="panel-body">
                        <form class="floating-labels form-mailtext" data-toggle="validator" id="form-mailtext-{{$text->id}}">
                            <div class="form-group m-b-40 m-t-20">
                                {!! Form::text('name-' . $text->id, $text->name, array('id' => 'id-name-'.$text->id , 'class' => 'form-control', 'required' => '')) !!}
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="id-name-{{$text->id}}">Naam van deze tekst</label>
                            </div>

                            <div class="form-group m-b-40 m-t-20">
                                {!! Form::text('title-' . $text->id, $text->title, array('id' => 'id-title-'.$text->id , 'class' => 'form-control', 'required' => '')) !!}
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="id-title-{{$text->id}}">Titel van deze E-Mail</label>
                            </div>

                            <div class="form-group m-b-40 m-t-20">
                                {!! Form::text('title-' . $text->id, $text->subject, array('id' => 'id-subject-'.$text->id , 'class' => 'form-control', 'required' => '')) !!}
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="id-subject-{{$text->id}}">Onderwerp van deze E-Mail</label>
                            </div>

                            <div class="form-group m-b-40 m-t-20">
                                {!! Form::textarea('text-' . $text->id, $text->text, array('id' => 'id-text-'.$text->id , 'class' => 'form-control', 'required' => '')) !!}
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="id-text-{{$text->id}}">Bericht van deze E-Mail @include('partials._components._icon-tooltip',array('fa' => 'fa-info-circle', 'text' => "(optioneel) u kunt ook html hier gebruiken bij uw bericht" )) </label>
                            </div>

                            <div class="form-group m-b-40 m-t-20">
                                {!! Form::select('type-' . $text->id, $types, null, array('id' => 'id-type-'.$text->id , 'class' => 'form-control', 'style' => 'padding-bottom: 0px', 'required' => '')) !!}
                                <label for="id-type-{{$text->id}}">Wat voor type mail is dit</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- /.row -->

@stop

@section('scripts')
    <script type="text/javascript">
        $(function(){
            $('.panel').lobiPanel({
                sortable: true,
                reload: false,
                editTitle: false,
                close: false,
                state: "collapsed"
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function (e) {

        })
    </script>
@stop