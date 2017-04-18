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
            $email_task->at_date = empty($email_task->at_date) ? null : Carbon::createFromFormat('Y-m-d', $email_task->at_date)->format('d-m-Y');
            $email_task->fk_mail_texts = MailTexts::find($email_task->fk_mail_texts);
        }
        return $tasks;
    }
}
