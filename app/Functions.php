<?php

namespace App;

use App\Http\Controllers\FunctionalController;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\College;

class Functions extends Model
{
    /**
     * Simple function that returns the table name of the database based on the Model
     *
     * @param $model
     * @return mixed
     */
    public static function getTablename($model){
        return with(new $model)->getTable();
    }

    /**
     * This function will return the difference between two dates as an integer.
     * @NOTE: THIS FUNCTION IS BETWEEN AN {TRY / CATCH} ||| RETURNS NULL IF (ERROR)
     *
     * @param $startDate
     * @param $endDate
     * @param $format
     * @return int|null
     */
    public static function DiffDays ($startDate, $endDate, $format) {
        try {
            # We make an Carbon object from the $startDate parameter
            $begin = Carbon::parse(date_format(date_create_from_format($format, $startDate), 'Y-m-d'));

            # We make an Carbon object form the $ endDate parameter
            $end = Carbon::parse(date_format(date_create_from_format($format, $endDate), 'Y-m-d'));

            # A difference in integers is returned.
            return $end->diffInDays($begin);
        }catch (\Exception $e) {
            return null;
        }
    }

    /**
     * This function will return the Default color of the College
     * @NOTE THIS FUNCTION IS UNDER DEVELOPMENT 
     * @param $id
     * @return string
     */
    public static function CollegeColor($id) {
        return FunctionalController::random_color();
        $college = College::find($id);
        $DefaultColleges = array();
    }
}
