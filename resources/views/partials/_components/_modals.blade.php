<!-- modal -->
<div id="{{$id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{$modal_title}}</h4> </div>
            <div class="modal-body">
                <form>
                    @if(!empty($inputs))
                        @foreach($inputs as $input)
                            <div class="form-group">
                                <label for="{{$input['id']}}" class="control-label">{{$input['label']}}</label>
                                <input type="text" class="{{$input['classes']}}" id="{{$input['id']}}">
                            </div>
                        @endforeach
                    @elseif (!empty($select))
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="button-box m-t-20">
                                    <a id="select-all" class="btn btn-success btn-outline" href="#">Selecteer Alles</a>
                                    <a id="deselect-all" class="btn btn-danger btn-outline" href="#">Deselecteer Alles</a>
                                </div>
                            </div>
                            <div class="col-xs-8">
                                <div class="form-group">
                                    <select {!! $select['options'] !!} id="{{$select['id']}}" name="{{$select['name']}}"></select>
                                </div>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="{{$btnClose_id}}" class="btn btn-default waves-effect" data-dismiss="modal">{{$btnClose_text}}</button>
                <button type="button" id="{{$btnAction_id}}" class="btn btn-danger waves-effect waves-light">{{$btnAction_text}}</button>
            </div>
        </div>
    </div>
</div>
<!-- / modal -->