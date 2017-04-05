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

    /**
     * This function is user to determine if a variable is empty
     * if so, the function returns a backup string
     * this function will save a few lines of code :)
     *
     * @param $value
     * @param $returnString
     * @return mixed
     */
    public static function nullIsString($value, $returnString)
    {
        if (empty($value)) {
            return $returnString;
        }

        return $value;
    }

    /**
     * This function will return an (integer) according to the giving string
     *
     * @param $string
     */
    public static function getStatusByString($string)
    {
        if (!is_string($string) && !is_int($string)) {
            return false;
        }

        if (is_string($string)) {
            $string = strtolower($string);
        }

        $status = null;
        switch ($string) {
            case "actief":
                $status = 1;
                break;
            case "non-actief":
                $status = 0;
                break;
            case "anders":
                $status = 2;
                break;
            case "ja":
                $status = 1;
                break;
            case "nee":
                $status = 0;
                break;
            case 0:
                $status = $string;
                break;
            case 1:
                $status = $string;
                break;
            case 2:
                $status = $string;
                break;
            default:
                $status = false;
                break;
        }
        return $status;
    }

    /**
     * This function the precise opposite of the "getStatusByString" function.
     * This function will return a string accourding to the status of the assessor
     *
     * @param $status
     * @return string
     */
    public static function getStringByStatus($status)
    {
        switch ($status) {
            case 0:
                $status = "Non-Actief";
                break;
            case 1:
                $status = "Actief";
                break;
            case 2:
                $status = "Anders";
                break;
        }
        return $status;
    }

    public static function decodeLangString($string)
    {
        switch ($string) {
            case strtolower($string) == "ja":
                $string = true;
                break;
            case strtolower($string) == "nee":
                $string = false;
                break;
            case strtolower($string) == "yes":
                $string = true;
                break;
            case strtolower($string) == "no":
                $string = false;
                break;
            case 0:
                $string = false;
                break;
            case 1:
                $string = true;
                break;
            case 2:
                $string = true;
                break;
        }
        return $string;
    }
}
