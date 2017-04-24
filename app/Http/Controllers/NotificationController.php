<?php

namespace App\Http\Controllers;

use App\MailTexts;
use App\ScheduleEmailTasks;
use App\SystemLog;
use App\UploadedFiles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;
use Schema;

class NotificationController extends Controller
{
    public $maxAttachments = 3;

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
                if ($value == "none") {
                    $value = array();
                }elseif (!is_array($value)) {
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
                if ($value == "") {
                    return $ret;
                }
                if (!is_numeric($value)) {
                    return $ret;
                }

                $task->repeat = $value;
                $task->save();
                $ret = true;
                break;
        }

        return json_encode($ret);
    }

    public function postSaveAttachment($id, Request $request)
    {
        $validation = Validator::make($request->all(), array(
            'attachment' => 'required|max:2000|mimes:.doc,docx,xls,xlsx,pdf,csv,txt'
        ));

        if ($validation->fails()) {
            return $validation->getMessageBag()->first();
        }

        $mailTask = ScheduleEmailTasks::find($id);
        if (empty($mailTask)) {
            return json_encode(array(
                'error' => true,
                'message' => "Fout, Mail opdracht was niet gevonden"
            ));
        }

        $currentAttachments = null;
        if (!empty($mailTask->uploaded_files)) {
            $currentAttachments = json_decode($mailTask->uploaded_files);
            if (count($currentAttachments) >= $this->maxAttachments) {
                return json_encode(array(
                    'error' => true,
                    'message' => "Mislukt, Er zijn al 3 bestanden aan deze mail bijgevoegd."
                ));
            }
        } else {
            $currentAttachments = json_decode(json_encode(array()));
        }

        $newFile = new UploadedFiles();
        $newFile->name = $request->file('attachment')->getClientOriginalName();
        $newFile->extension = $request->file('attachment')->getClientSize();
        $newFile->size = $request->file('attachment')->getClientSize();
        try {
            $newFile->path = $request->file('attachment')->store('attachments');
        } catch (\Exception $exception) {
            SystemLog::LOG(__FUNCTION__, 'Upload Failed', $exception->getMessage(), Auth::user()->id);
            return json_encode(array(
                'error' => true,
                'message' => "Fout, Bestand kon niet geupload worden probeer later nog een keer..."
            ));
        }
        $newFile->save();

        $currentAttachments[] = $newFile->id;
        $mailTask->uploaded_files = json_encode($currentAttachments);
        $mailTask->save();

        return json_encode(array(
            'id' => $mailTask->id,
            'file' => $newFile->toJson(),
            'title' => 'Upload Voltooid',
            'message' => 'Bijlage was succesvol toegevoegd aan deze E-Mail',
            'status' => 'success',
        ));
    }

    public function postRemoveAttachment($id, Request $request)
    {
        $mailTask = ScheduleEmailTasks::find($id);
        if (empty($mailTask)) {
            return array(
                'error' => true,
                'message' => "Mail was niet gevonden"
            );
        }

        $validate = Validator::make($request->all(), array(
            'id' => 'required|Numeric'
        ));

        if ($validate->fails()) {
            return array(
                'error' => true,
                'message' => "Geen bijlage was gevonden om te verwijderen"
            );
        }

        $attachments = json_decode($mailTask->uploaded_files);
        if (!empty($attachments)) {
            foreach ($attachments as $key => $id) {
                if ($id == $request->id) {
                    $file = UploadedFiles::find($id);
                    Storage::delete($file->path);
                    $file->delete();

                    unset($attachments[$key]);
                    $mailTask->uploaded_files = json_encode($attachments);
                    $mailTask->save();
                }
            }
            return array(
                'error' => false,
                'message' => "Bijlage was successvol verwijderd"
            );
        }

    }

    public function postNewNotification()
    {
        try {
            $notification = new ScheduleEmailTasks();
            $notification->table = '';
            $notification->fk_mail_texts = MailTexts::newMail();
            $notification->to = json_encode(array());
            $notification->save();
        } catch (\Exception $exception) {
            return json_encode(false);
        }

        return json_encode(true);
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
