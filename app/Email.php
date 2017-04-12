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

        $email = new self();
        $email->to = $data['to'];
        $email->from = "roctracker@gmail.com";
        $email->subject = $data['subject'];
        $email->text = $data['text'];

        try {
            Mail::send('mails.email', $data, function ($message) use ($data) {
                $message->to($data['to'])
                    ->from('roctracker@gmail.com', "ROCTracker")
                    ->subject($data['subject']);
            });
        } catch (\Exception $e) {
            $email->send = 0;
            $email->save();
            SystemLog::create(array(
                'title' => "Email send()",
                'subject' => "Failed to send()",
                'message' => $e->getMessage(),
                'fk_users' => \Auth::user()->id
            ));

            return false;
        }

        $email->send = 1;
        $email->save();

        return true;
    }

    public static function resend($id)
    {
        $email = Email::find($id);
        if (empty($email)) {
            return false;
        } else {

            $data = array(
                'to' => $email->to,
                'type' => 'info',
                'subject' => $email->subject,
                'title' => $email->subject,
                'text' => $email->text
            );

            try {
                Mail::send('mails.email', $data, function ($message) use ($data) {
                    $message->to($data['to'])
                        ->from('roctracker@gmail.com', "ROCTracker")
                        ->subject($data['subject']);
                });
            } catch (\Exception $e) {
                $email->send = 0;
                $email->save();
                SystemLog::create(array(
                    'title' => "Email send()",
                    'subject' => "Failed to send()",
                    'message' => $e->getMessage(),
                    'fk_users' => \Auth::user()->id
                ));

                return false;
            }

        }

        $email->send = 1;
        $email->save();

        return true;
    }
}
