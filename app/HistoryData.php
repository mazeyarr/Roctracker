<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryData extends Model
{
    public static function generate()
    {
        $data = array();
        foreach (College::all() as $college) {
            $data[$college->id] = array(
                'current' => date('Y'),
                'should' => 1 + round(Assessors::where('fk_college', $college->id)->where('status', 1)->count() / 100 * 110),
                'count' => Assessors::where('fk_college', $college->id)->where('status', 1)->count()
            );
        }
        return $data;
    }
}
