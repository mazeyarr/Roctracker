<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduleEmailTasks extends Model
{
    public static function getAll()
    {
        $tasks = self::all();
        foreach ($tasks as $email_task) {
            $email_task->fk_mail_texts = MailTexts::find($email_task->fk_mail_texts);
        }
        return $tasks;
    }
}
