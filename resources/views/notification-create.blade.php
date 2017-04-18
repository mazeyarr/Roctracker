@extends('layouts.app')

@section('title', 'Berichten Aanmaken')

@section('page-title', 'Berichten Aanmaken')

@section('content')
    <div class="row">
        @foreach($texts as $text)
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading"> {{$text->fk_mail_texts->name}}
                    </div>
                    <div class="panel-body">
                        <form class="floating-labels form-mailtext" data-toggle="validator" id="form-mailtext-{{$text->fk_mail_texts->id}}">
                            <div class="form-group m-b-40 m-t-20">
                                {!! Form::text('name-' . $text->fk_mail_texts->id, $text->fk_mail_texts->name, array('id' => 'id-name-'.$text->fk_mail_texts->id , 'class' => 'form-control', 'required' => '')) !!}
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="id-name-{{$text->fk_mail_texts->id}}">Naam van deze tekst</label>
                            </div>

                            <div class="form-group m-b-40 m-t-20">
                                {!! Form::text('title-' . $text->fk_mail_texts->id, $text->fk_mail_texts->title, array('id' => 'id-title-'.$text->fk_mail_texts->id , 'class' => 'form-control', 'required' => '')) !!}
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="id-title-{{$text->fk_mail_texts->id}}">Titel van deze E-Mail</label>
                            </div>

                            <div class="form-group m-b-40 m-t-20">
                                {!! Form::text('subject-' . $text->fk_mail_texts->id, $text->fk_mail_texts->subject, array('id' => 'id-subject-'.$text->fk_mail_texts->id , 'class' => 'form-control', 'required' => '')) !!}
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="id-subject-{{$text->fk_mail_texts->id}}">Onderwerp van deze E-Mail</label>
                            </div>

                            <div class="form-group m-b-40 m-t-20">
                                {!! Form::textarea('text-' . $text->fk_mail_texts->id, $text->fk_mail_texts->text, array('id' => 'id-text-'.$text->fk_mail_texts->id , 'class' => 'form-control', 'required' => '')) !!}
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="id-text-{{$text->fk_mail_texts->id}}">Bericht van deze E-Mail @include('partials._components._icon-tooltip',array('fa' => 'fa-info-circle', 'text' => "(optioneel) u kunt ook html hier gebruiken bij uw bericht" )) </label>
                            </div>

                            <div class="form-group m-b-40 m-t-20">
                                {!! Form::select('type-' . $text->fk_mail_texts->id, $types, null, array('id' => 'id-type-'.$text->fk_mail_texts->id , 'class' => 'form-control', 'required' => '', 'style' => 'padding: 0px;')) !!}
                                <label for="id-type-{{$text->fk_mail_texts->id}}">Wat voor type mail is dit</label>
                            </div>

                            <h2>Planning</h2>
                            <hr>
                            <div class="form-group m-b-40 m-t-40">
                                {!! Form::text('at_date-' . $text->id, $text->subject, array('id' => 'id-at_date-'.$text->id , 'class' => 'form-control', 'required' => '')) !!}
                                <span class="highlight"></span> <span class="bar"></span>
                                <label for="id-at_date-{{$text->id}}">Verstuur Datum <small>(dd-mm-yyyy)</small></label>
                            </div>
                            <div class="form-group m-t-20">
                                {!! Form::select('to-' . $text->id, array('teamleaders' => "Teamleiders", 'assessors' => "Assessoren"), $text->table, array('id' => 'id-to-'.$text->id , 'class' => 'form-control', 'required' => '', 'style' => 'padding: 0px;')) !!}
                                <label for="id-to-{{$text->id}}">Naar wie word deze email verstuurd ?</label>
                            </div>
                            <div class="form-group m-b-40">
                                {!! Form::button('Email lijst maken', array('class' => 'btn btn-success')) !!}
                            </div>
                            <div class="checkbox checkbox-success p-t-0 m-b-40">
                                {!! Form::checkbox('repeat-' . $text->id, null, $text->repeat, array('id' => 'id-repeat-'.$text->id , 'class' => 'form-control', 'required' => '')) !!}
                                <label for="id-repeat-{{$text->id}}">Deze mail herhalen op ingevoerde datum ?</label>
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