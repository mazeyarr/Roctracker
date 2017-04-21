<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailTexts extends Model
{
    public static $mailTypes = array(
        'info' => 'Informatieve',
        'success' => 'Succesvole',
        'warning' => 'Waarschuwing',
        'danger' => 'Dringend',
    );

    public static function newMail()
    {
        $mail = new MailTexts();
        $mail->name = "Mail: " . Log::generateRandomString(5);
        $mail->title = "";
        $mail->subject = "";
        $mail->text = "";
        $mail->type = "";
        $mail->save();

        return $mail->id;
    }
}
