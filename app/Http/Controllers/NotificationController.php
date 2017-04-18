<?php

namespace App\Http\Controllers;

use App\MailTexts;
use App\ScheduleEmailTasks;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function postSaveNotification(Request $request)
    {
        $validate = Validator::make($request->all(), array(
            'id' => 'required',
            'name' => 'required',
            'value' => 'required',
        ));

        if ($validate->fails()) {
            return json_encode(false);
        }

        $id = $request->id;
        $fieldname = $request->name;
        $value = $request->value;

        $task = ScheduleEmailTasks::find($id);
        if (empty($task)) {
            return json_encode(false);
        }

        $mailText = MailTexts::find($task->fk_mail_texts);

        $ret = json_encode(false);
        switch ($fieldname) {
            case "name":
                if ($value == "") {
                    return $ret;
                }
                $mailText->name = $value;
                $mailText->save();
                $ret = true;
                break;
            case "title":
                if ($value == "") {
                    return $ret;
                }
                $mailText->title = $value;
                $mailText->save();
                $ret = true;
                break;
            case "subject":
                if ($value == "") {
                    return $ret;
                }
                $mailText->subject = $value;
                $mailText->save();
                $ret = true;
                break;
            case "text":
                if ($value == "") {
                    return $ret;
                }
                $mailText->text = $value;
                $mailText->save();
                $ret = true;
                break;
            case "type":
                // TODO: SELECT BOX
                break;

            case "at_date":
                if ($value == "") {
                    return $ret;
                }
                if (preg_match("/[a-z]/i", $value)) {
                    return $ret;
                }
                $validate_date = Validator::make($request->all(), array('value' => 'date_format:d-m-Y'));
                if ($validate_date->fails()) {
                    return $ret;
                }
                $date = Carbon::createFromFormat('d-m-Y', $value);
                if ($date->format('Y') < date('Y')) {
                    return $ret;
                }
                $task->at_date = $date->format('Y-m-d');
                $task->save();
                $ret = true;
                break;
            case "to":
                // TODO: JSON ARRAY
                break;
            case "table":
                // TODO: SELECT BOX
                break;
            case "repeat":
                // TODO: CHECKBOX
                break;
        }

        return json_encode($ret);
    }
}
