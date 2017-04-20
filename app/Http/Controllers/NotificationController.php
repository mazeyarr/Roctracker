<?php

namespace App\Http\Controllers;

use App\MailTexts;
use App\ScheduleEmailTasks;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Schema;

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

            # Mail Texts table fields
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
                $mailTypes = MailTexts::$mailTypes;
                if (!array_key_exists($value, $mailTypes)) {
                    return $ret;
                }
                $mailText->type = $value;
                $mailText->save();
                $ret = true;
                break;

            # Schedule Email Tasks table fields
            case "at_date":
                if ($value == "") {
                    return $ret;
                }
                if (preg_match("/[a-z]/i", $value)) {
                    return $ret;
                }
                $validate_date = Validator::make($request->all(), array('value' => 'date_format:d-m-Y H:i'));
                if ($validate_date->fails()) {
                    return $ret;
                }
                $date = Carbon::createFromFormat('d-m-Y H:i', $value);
                if ($date->format('Y') < date('Y')) {
                    return $ret;
                }
                $task->at_date = $date->format('Y-m-d H:i:s');
                $task->save();
                $ret = true;
                break;
            case "to":
                if ($value == "") {
                    return $ret;
                }
                if (!is_array($value)) {
                    return $ret;
                }

                $task->to = json_encode($value);
                $task->save();
                $ret = true;
                break;
            case "table":
                if (!Schema::hasTable($value)) {
                    return $ret;
                }
                $task->table = $value;
                $task->save();
                $ret = true;
                break;
            case "repeat":
                // TODO: CHECKBOX
                break;
        }

        return json_encode($ret);
    }

    public function ajaxGetCurrentReceivers($mail_task_id)
    {
       $task = ScheduleEmailTasks::find($mail_task_id);
        if (empty($task)) {
            return false;
        }

        return $task->to;
    }
}
