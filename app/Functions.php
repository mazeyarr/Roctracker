<?php

namespace App;

use App\Http\Controllers\FunctionalController;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Functions extends Model
{
    public static function getTablename($model){
        return with(new $model)->getTable();
    }

    public static function DiffDays ($startDate, $endDate, $format) {
        try {
            $begin = Carbon::parse(date_format(date_create_from_format($format, $startDate), 'Y-m-d'));
            $end = Carbon::parse(date_format(date_create_from_format($format, $endDate), 'Y-m-d'));
            return $end->diffInDays($begin);
        }catch (\Exception $e) {
            return null;
        }
    }

    public static function CollegeColor($id) {
        return FunctionalController::random_color();
        $college = College::find($id);
        $DefaultColleges = array();
    }
}
