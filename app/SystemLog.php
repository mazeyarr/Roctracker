<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This class will save system errors and exceptions
 *
 * Class SystemLog
 * @package App
 */
class SystemLog extends Model
{
    # We do this to make the Fields in the database mass assignable
    protected $fillable = ['title', 'subject', 'message', 'fk_users'];

    /**
     * This function will log the error to the database
     *
     * @param $title
     * @param $subject
     * @param $message
     * @param $user_id
     * @return bool
     */
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
