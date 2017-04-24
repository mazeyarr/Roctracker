<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ScheduleEmailTasks extends Model
{
    public static function getAll()
    {
        $tasks = self::all();
        foreach ($tasks as $email_task) {
            $email_task->at_date = empty($email_task->at_date) ? null : Carbon::createFromFormat('Y-m-d H:i:s', $email_task->at_date)->format('d-m-Y H:i');
            $email_task->fk_mail_texts = MailTexts::find($email_task->fk_mail_texts);
            if (!empty($email_task->uploaded_files)) {
                $attachments = json_decode($email_task->uploaded_files);
                foreach ($attachments as $key => $attachmentID) {
                    $attachments[$key] = UploadedFiles::find($attachmentID);
                }
                $email_task->uploaded_files = $attachments;
            }else {$email_task->uploaded_files = null;}
        }
        return $tasks;
    }

    public static function getAttachments($id)
    {
        $task = self::find($id);
        $ret = null;
        if (!empty($task->uploaded_files)) {
            $attachments = json_decode($task->uploaded_files);
            foreach ($attachments as $key => $attachmentID) {
                $attachments[$key] = UploadedFiles::find($attachmentID);
            }
            $ret = $attachments;
        }else {$ret = null;}

        return $ret;

    }
}
