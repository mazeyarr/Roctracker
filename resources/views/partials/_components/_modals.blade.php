<!-- modal -->
<div id="{{$id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
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
                        <div class="form-group">
                            <select {!! $select['options'] !!} id="{{$select['id']}}" name="{{$select['name']}}"></select>
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