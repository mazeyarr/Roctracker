<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teamleaders extends Model
{
    public static function GetUnsigned() {
        $leaders = self::where('college_id', '=', null)->get();
        if (empty($leaders)) {
            return false;
        }
        return $leaders;
    }
}
