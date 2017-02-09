<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryData extends Model
{
    public static function sorted ($year) {
        if (empty($year)) { return null; }
        if (self::where('year', '=', $year)->get()->isEmpty()) { return null; }
        return self::where('year', '=', $year)->first();

    }
}
