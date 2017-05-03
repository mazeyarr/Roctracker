<div class="form-group">
    <label class="col-sm-12">In welk college wilt u zoeken ?</label>
    <div class="col-sm-12">
        {!! Form::select('searchOnCollege', \App\College::toSelect(), 0, array('id' => 'advancedSearchOnCollege', 'class' => 'form-control')) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-12">Op welke Status zoekt u ?</label>
    <div class="col-sm-12">
        {!! Form::select('searchOnStatus', array('none' => "Alle Statussen", 1 => 'Actief', 0 => 'Non-Actief', 2=> 'Anders'), 'none', array('id' => 'advancedSearchOnStatus', 'class' => 'form-control')) !!}
    </div>
</div>

<label class="m-b-5">Wilt u op leeftijd zoeken ?</label>
<div class="form-group">
    <div class="col-md-12">
        <div class="checkbox checkbox-primary pull-left p-t-0 p-l-0">
            <input id="advancedSwitchAge" class="radio-switch" type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Ja" data-off-text="Nee">
        </div>
    </div>
    <div class="col-md-12 m-t-10">
        <div id="container-advancedSwitchAge" class="form-group" style="display: none;">
            <div class="col-md-5">
                <label for="searchOnAgeTo">Van:</label>
                {!! Form::text('searchOnAgeFrom', 0, array('id' => 'searchOnAgeFrom', 'class' => 'form-control')) !!}
                 <span class="highlight"></span> <span class="bar"></span>
            </div>
            <div class="col-md-2" style="margin-top: 25px">
                {!! Form::select('searchOnAgeOption', array(0 => '=', 1 => '>', 2 => '> = <', 3 => '<'), 'none', array('id' => 'advancedSearchOnAgeParameter', 'class' => 'form-control')) !!}
            </div>
            <div id="container-advancedSwitchAge_searchOnAgeTo" class="col-md-5" style="display: none;">
                <label for="searchOnAgeTo">Tot:</label>
                {!! Form::text('searchOnAgeTo', 0, array('id' => 'searchOnAgeTo', 'class' => 'form-control')) !!}
                 <span class="highlight"></span> <span class="bar"></span>
            </div>
        </div>
    </div>
</div>

<label class="m-b-5">Basistraining ?</label>
<div class="form-group">
    <div class="col-md-12">
        <div class="checkbox checkbox-primary pull-left p-t-0 p-l-0">
            <input id="advancedSwitchBasictraining" class="radio-switch" type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Behaald" data-off-text="Niet Behaald">
        </div>
    </div>
    {{-- TODO: MAKE CONTAINER FOR ALL BASICTRAINING OPTIONS--}}
</div>

<script src="{!! URL::asset('plugins/bower_components/bootstrap-switch/bootstrap-switch.min.js') !!}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var body = $('body'),
            ageSwitch = $('#advancedSwitchAge'),
            basictrainingSwitch = $('#advancedSwitchBasictraining'),
            containerAge = $('#container-advancedSwitchAge');

        ageSwitch.bootstrapSwitch();

        body.on('switchChange.bootstrapSwitch', function (event, state) {
            switch (event.target.id) {
                case "advancedSwitchAge":
                    if (state) {
                        var ageOption = $('#advancedSearchOnAgeParameter');
                        ageOption.on('change', function () {
                            if($(this).val() === "2") {
                                $('#container-advancedSwitchAge_searchOnAgeTo').show(500);
                            }else {
                                $('#container-advancedSwitchAge_searchOnAgeTo').hide(500);
                            }
                        });
                        containerAge.show(500);
                        return;
                    }
                    containerAge.hide(500);
                break;

                case "advancedSwitchBasictraining":
                    if (state) {

                    }
                break;
            }
        });
    });
</script>