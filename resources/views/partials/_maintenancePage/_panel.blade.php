<?php $collegeCell = "cell-".\App\Log::generateRandomString(5) ?>
<?php $teamleaderCell = "cell-".\App\Log::generateRandomString(5) ?>
<tr id="{{$row_ID}}" data-replacement="{{!empty($option_VALUE) ? $option_VALUE : ''}}" data-group="{{$groupID}}" data-college="{{$collegeCell}}" data-teamleader="{{$teamleaderCell}}">
    <th scope="row">{{$rowCount}}</th>
    <td>
        <select class="select-assessor" name="{{$select_NAME}}" id="{{$select_ID}}">
            @if(empty($option_VALUE))
                <option value="reserve">Reserve</option>
            @else
                <option value="{{$option_VALUE}}">{{$option_innerHTML}}</option>
            @endif

            @foreach($assessors as $assessor)
                @if($option_VALUE != $assessor['assessor']->id)
                    <option value="{{$assessor['assessor']->id}}">{{$assessor['assessor']->name}}</option>
                @endif
            @endforeach

            @if(!empty($option_VALUE))
                <option value="reserve">Reserve</option>
            @endif
        </select>
    </td>
    <td id="{{$collegeCell}}"> {{ !empty($participantCollege) ? $participantCollege->name : '' }} </td>
    <td id="{{$teamleaderCell}}"> {{ !empty($participantTeamleader) ? $participantTeamleader->name : '' }} </td>
</tr>