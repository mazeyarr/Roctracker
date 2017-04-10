<?php

namespace App;

use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;

/**
 * This class will handle every email send from this system.
 *
 * Class Email
 * @package App
 */
class Email extends Model
{
    public $fillable = ['to', 'from', 'text', 'send'];

    public static function send($to, $type, $subject, $title, $text)
    {
        $data = array(
            'to' => $to,
            'type' => $type,
            'subject' => $subject,
            'title' => $title,
            'text' => $text
        );

        Mail::send('mails.email', $data, function ( $message ) use ($data) {
            $message->to($data['to'])
                    ->from('roctracker@gmail.com', "ROCTracker")
                    ->subject($data['subject']);
        });

        $email = new self();
        $email->to = $data['to'];
        $email->from = "roctracker@gmail.com";
        $email->text = $text;
        $email->send = 1;
        $email->save();
    }
}
