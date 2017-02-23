<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    protected $fillable = ['title', 'subject', 'message', 'fk_users'];
    public static function LOG($title, $subject, $message, $user_id)
    {
        $Log = self::create([
            'title' => $title,
            'subject' => $subject,
            'message' => json_encode($message),
            'fk_users' => $user_id
        ]);

        // TODO: MAIL THE LOG ID TO DEVELOPER !

        return true;
    }
}
