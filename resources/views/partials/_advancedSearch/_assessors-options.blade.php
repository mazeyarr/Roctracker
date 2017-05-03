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