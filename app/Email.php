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
    public static $from = "roctracker@gmail.com";

    public static function send($to, $type, $subject, $title, $text, $attachments=null)
    {
        $data = array(
            'to' => $to,
            'type' => $type,
            'subject' => $subject,
            'title' => $title,
            'text' => $text,
            'attachments' => $attachments
        );

        $email = new self();
        $email->to = $data['to'];
        $email->from = self::$from;
        $email->subject = $data['subject'];
        $email->text = $data['text'];

        try {
            Mail::send('mails.email', $data, function ($message) use ($data) {
                $message->to($data['to'])
                    ->from(self::$from, "ROCTracker")
                    ->subject($data['subject']);

                if (!empty($data['attachments'])) {
                    foreach ($data['attachments'] as $key => $id) {
                        $file = UploadedFiles::find($id);
                        if (!empty($file)) {
                            $message->attach(storage_path('app/' . $file->path), ['as' => $file->name]);
                        }
                    }
                }
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
        $email = self::find($id);
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
                        ->from(self::$from, "ROCTracker")
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
