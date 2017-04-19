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
}
