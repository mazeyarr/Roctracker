<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryData extends Model
{
    public $fillable = ['year', 'assessor_data', 'actieve_assessors', 'c_assessors', 'c_colleges', 'c_teamleaders', 'c_teamleaders_in_colleges', 'year_checked', 'log'];

    public static function sorted ($year) {
        if (empty($year)) { return null; }
        if (self::where('year', '=', $year)->get()->isEmpty()) { return null; }
        return self::where('year', '=', $year)->first();

    }

    public static function data() {
        $data = array(
            'data' => array()
        );
        foreach (College::all() as $college) {
            $data['data'][] = array(
                'label' => $college->name,
                'data' => Assessors::where('fk_college', $college->id)->count(),
                'value' => Assessors::where('fk_college', $college->id)->count(),
                'color' => "#". Functions::CollegeColor($college->id),
            );
        }
        return json_encode($data);
    }
}
